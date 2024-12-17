<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Order;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($id)
    {
        $order_inv = Order::with('orderProducts', 'orderAddress')->where('id', $id)->first();
        // dd($order_inv);
        return view('stripe', compact('order_inv'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
{
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $totalAmount = $request->total_amount;

    try {
        $charge = Stripe\Charge::create ([
            "amount" => $totalAmount * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from ."
        ]);

        // Update order status to 5 (payment successful)
        $order = Order::findOrFail($request->order_id);
        $order->order_status = 5;
        $order->save();

        Session::flash('success', 'Payment successful!');

        return redirect()->route('front.order-thanks-page', ['order_id' => $request->order_id]);
    } catch (Stripe\Exception\CardException $e) {
        // Catch any errors thrown by Stripe (e.g., card errors)
        $error = $e->getError();
        $errorMessage = $error->message;

        // Display the error message to the user (you can modify this as needed)
        return back()->with('error', $errorMessage);
    } catch (Exception $e) {
        // Catch any other unexpected errors
        return back()->with('error', 'An unexpected error occurred. Please try again later.');
    }
}
}
