<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Pagination\LengthAwarePaginator;

use Auth;
use DB;
class OrderController extends Controller
{
    public function index()
    {
      
        $orders = Order::with('orderProducts')->where('user_id', Auth::id())->latest()->get();
// dd($orders);
        return view('frontend.order.index', compact('orders'));
    }
    
    public function return_req($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        // Check if the order exists
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update the is_return field
        $order->is_return = 'Requested';
        $order->save(); // Save changes to the database

        // Redirect back with success message
        return redirect()->back()->with('success', 'Return request submitted successfully.');
    }

    public function order_list($phone)
    {
      
        $orders = Order::with('orderProducts')->where('order_phone', $phone)->latest()->get();
      	$order_inv = Order::with('orderProducts')->where('order_phone', $phone)->first();
      			  
        return view('frontend.order.index', compact('orders', 'order_inv'));
    }
  	public function thanks_page($phone)
    {
      	$order_inv = Order::with('orderProducts')->where('order_phone', $phone)->first();
        return view('frontend.order.thanks_page', compact('order_inv'));
    }
  	

    public function show($id)
    {
      // dd('ok');
        $order = Order::with('user', 'orderProducts')->findOrFail($id);
      //dd($order);

        // $view = view('frontend.order.show', compact('order'))->render();
        // return response()->json([
        //     'status' => true,
        //     'html' => $view,
        // ]);
        return view('frontend.order.show', compact('order'));
    }    
    
    public function print($id)
    {
        $order = Order::with('user', 'orderProducts')->findOrFail($id);

        return view('frontend.order.print', compact('order'));
    }
    public function internal_credit()
    {
        if (auth()->check()) {
            $credits = \App\Models\Credit::where('user_id', auth()->id())
                ->latest()
                ->paginate(30); // Pagination set to 30 records per page.
    
            $totalCredit = \App\Models\Credit::where('user_id', auth()->id())
                ->sum('credit_amount'); // Calculate the total credit.
    
            return view('frontend.order.internal_credit', compact('credits', 'totalCredit'));
        } else {
            return redirect()->route('login')->with('error', 'You need to log in to view this page.');
        }
    }

    public function order_balance_sheet()
{
    $userId = auth()->id();

    // Fetch debits from orders (e.g., total spent)
    $debits = Order::where('user_id', $userId)
        ->where('order_status', 'completed') // Assuming completed orders count as debit
        ->select('id', 'total_amount as debit', 'created_at as transaction_date')
        ->get();

    // Fetch credits from orders (or another table, e.g., cashback/rewards)
    $credits = \App\Models\Credit::where('user_id', $userId)
        ->whereNotNull('credit_amount') // Assuming credit_amount stores user credits
        ->select('id', 'credit_amount as credit', 'created_at as transaction_date')
        ->get();

    // Combine and sort transactions
    $transactions = $debits->concat($credits)
        ->sortBy('transaction_date')
        ->map(function ($item) {
            return [
                'transaction_date' => $item->transaction_date,
                'debit' => $item->debit ?? 0,
                'credit' => $item->credit ?? 0,
            ];
        });

    // Calculate running balance
    $balance = 0;
    $transactions = $transactions->map(function ($item) use (&$balance) {
        $balance += $item['credit'] - $item['debit']; // Correct formula
        $item['balance'] = $balance;
        return $item;
    });

    // Paginate transactions manually
    $perPage = 30;
    $page = request()->get('page', 1);
    $paginatedTransactions = new LengthAwarePaginator(
        $transactions->slice(($page - 1) * $perPage, $perPage)->values(),
        $transactions->count(),
        $perPage,
        $page,
        ['path' => request()->url()]
    );

    return view('frontend.order.balance_sheet', [
        'transactions' => $paginatedTransactions,
        'totalCredit' => $transactions->sum('credit'),
        'totalDebit' => $transactions->sum('debit'),
        'currentBalance' => $balance,
    ]);
}


public function showPaymentPage(Order $order)
{
    if ($order->payment_status === 'paid') {
        return redirect()->route('user.orders')->with('error', 'This order is already paid.');
    }

    return view('frontend.order.payment', compact('order'));
}


public function processPayment(Request $request, Order $order)
{
    $request->validate([
        'payment_method' => 'required',
        'payment_amount' => 'required|numeric|min:1|max:' . $order->due_amount,
    ]);

    $paymentMethod = $request->payment_method;
    $paymentAmount = $request->payment_amount;

    try {
        DB::beginTransaction();

        // Handle credit payment
        if ($paymentMethod === 'credit') {
            $user = Auth::user();

            // Check if the user has enough credit
            if ($user->credit < $paymentAmount) {
                return redirect()->back()->with('error', 'Not enough credit.');
            }

            // Deduct the payment amount from the user's credit
            $user->credit -= $paymentAmount;
            $user->save();
        } 
        // Handle Stripe payment
        elseif ($paymentMethod === 'stripe') {
            // Redirect to Stripe payment page with payment details
            return redirect()->route('stripe.index', [$order->id])->with('payment_amount', $paymentAmount);
        }

        // Update order's due amount
        $order->due_amount -= $paymentAmount;

        // Update payment status based on the remaining due amount
        if ($order->due_amount <= 0) {
            $order->payment_method = 'paid';
            $order->due_amount = 0; // Ensure due amount is 0
        } else {
            $order->payment_method = 'partial';
        }

        // Save the order changes
        $order->save();

        DB::commit();

        return redirect()->route('user.orders')->with('success', 'Payment successful.');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
    }
}




    

}
