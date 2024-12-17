<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\City;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use App\Models\FlashSaleProduct;
use App\Models\FlashSale;
use App\Models\Shipping;
use App\Models\Setting;
use App\Models\ProductVariant;
use App\Models\productColorVariation;
use Auth, DB;

class CheckoutController extends Controller
{




    public function index()
    {
       $cart = session()->get('cart', []);
      //dd($cart);

    if (count($cart) <= 0) {
        return redirect()->route('front.home');
    }

    $user = Auth::user();
    $countries = Country::select('id', 'name')->orderBy('name')->get();
    $shippings = Shipping::with('city')->orderBy('id', 'asc')->get();
    $setting = Setting::first();

    return view('frontend.cart.checkout', compact('cart', 'countries', 'user', 'shippings', 'setting'));
    }

    public function checkoutsing($product_id)
    {

        $user = Auth::user();
        $product = Product::find($product_id); // Fetch the product based on product ID
        $cart = [$product_id => [
            'name' => $product->name,
            'price' => $product->price,
          	'variation_color_id' => $product->variation_color_id,
          	'variation_color_id' => $item['variation_color_id'],
            'variation' => $item['variation'],
            'quantity' => 1, // Assuming you want to add only 1 quantity
            // Other product details
        ]];

        $countries = Country::select('id', 'name')->orderBy('name')->get();
        $shippings = Shipping::with('city')->orderBy('id', 'asc')->get();
        $setting = Setting::first();
        // return redirect()->route('front.checkout.index');
        return view('frontend.cart.index', compact('cart', 'countries', 'user', 'shippings', 'setting'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{
    // Validate request
    $inputs = $request->validate([
        'billing_name' => '',
        'billing_email' => '',
        'billing_phone' => '',
        'billing_address' => '',
        'billing_country' => '',
        'billing_state' => '',
        'billing_city' => '',
        'billing_address_type' => '',
        'shipping_name' => 'required',
        'shipping_email' => '',
        'order_phone' => 'required',
        'shipping_address' => '',
        'shipping_country' => '',
        'shipping_state' => '',
        'shipping_city' => '',
        'shipping_address_type' => '',
        'payment_method' => 'required',
        'shipping_method' => '',
        'transection_id' => '',
        'ip_address' => '',
    ]);

    $user = Auth::user();
    $checkinguser = User::where('phone', $inputs['order_phone'])->first();

    // Guest user handling
    if (empty(auth()->user()->id)) {
        $user = User::create([
            'name' => $request->shipping_name,
            'phone' => $request->order_phone,
            'address' => $request->shipping_address,
        ]);

        $data['user_id'] = $user->id;
    } else {
        $data['user_id'] = auth()->user()->id;
    }

    // Determine user phone
    $ord_phn = $checkinguser ? $checkinguser->phone : $user->phone;

    $shipping_rule = Shipping::find($inputs['shipping_method'])->shipping_rule;
    $shipping_id = $inputs['shipping_method'];

    $total = $this->calculateCartTotal(
        $user,
        1235,
        $shipping_id
    );

    $lastOrder = Order::latest()->first();
    $newOrderNumber = $lastOrder ? $lastOrder->order_id + 1 : 1;

    $data = [];
    $data['order_id'] = $newOrderNumber;
    $data['user_id'] = $user->id;
    $data['order_phone'] = $ord_phn;
    $data['ip_address'] = $request->ip_address;
    $data['product_qty'] = cartTotalAmount()['total_qty'];
    $data['payment_method'] = $request->payment_method;
    $data['shipping_method'] = $shipping_rule;
    $data['ordered_delivery_date'] = $request->ordered_delivery_date;
    $data['ordered_delivery_time'] = $request->ordered_delivery_time;
    $data['total_amount'] = $total["total_price"];
    $data['coupon_coast'] = $total["coupon_price"];
    $data['shipping_cost'] = $total["shipping_fee"];
    $data['order_status'] = 0;
    $data['cash_on_delivery'] = 0;
    $data['additional_info'] = 0;
    $data['assign_id'] = User::inRandomOrder()->first()->id;

    // Payment Method Logic
    $paymentMethod = $request->payment_method;
    try {
        DB::beginTransaction();

         // Credit Payment Logic
         if ($paymentMethod === 'credit_payment') {
            $requiredAmount = $total["total_price"];
            if ($user->credit >= $requiredAmount) {
                // Full payment with credit
                $user->credit -= $requiredAmount;
                $user->save();
                $data['payment_method'] = 'credit';
                $data['order_status'] = 1; // Completed
            } else {
                // Partial payment with credit
                $usedCredit = $user->credit;
                $remainingDue = $requiredAmount - $usedCredit;

                $user->credit = 0; // All credit used
                $user->save();

                $data['payment_method'] = 'partial';
                $data['order_status'] = 7; // Partial payment
                $data['due_amount'] = $remainingDue;
            }
        } elseif ($paymentMethod === 'due') {
            // Mark the entire order as due
            $data['payment_method'] = 'due';
            $data['order_status'] = 8; // Due payment
            $data['due_amount'] = $total["total_price"];
        }


        $order = Order::create($data);

        if ($order) {
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'seller_id' => 0,
                    'product_name' => $item['name'],
                    'variation_color_id' => $item['variation_color'],
                    'variation' => $item['variation_size'],
                    'unit_price' => $item['price'],
                    'total_discount' => $data['product_qty'] * $item['discount_price'],
                    'qty' => $item['quantity']
                ]);

                $single_product = Product::find($item['product_id']);
                $single_product->sold_qty += $item['quantity'];
                $single_product->qty -= $item['quantity'];
                $single_product->save();
            }

            $order->orderAddress()->create([
                'billing_name' => $request->billing_name,
                'billing_email' => $request->billing_email,
                'billing_phone' => $request->billing_phone,
                'billing_address' => $request->billing_address,
                'billing_country' => $request->billing_country,
                'billing_state' => $request->billing_state,
                'billing_city' => $request->billing_city,
                'billing_address_type' => $request->billing_address_type,
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $ord_phn,
                'shipping_address' => $request->shipping_address,
                'shipping_country' => $request->shipping_country,
                'shipping_state' => $request->shipping_state,
                'shipping_city' => $request->shipping_city,
                'shipping_address_type' => $request->shipping_address_type,
                'payment_method' => $request->payment_method,
                'shipping_method' => $request->shipping_method,
                'transection_id' => $request->transection_id,
            ]);
        }

        DB::commit();

        // Clear cart and session data
        session()->put('cart', []);
        session()->put('coupon', []);

        if ($paymentMethod === 'credit_payment') {
            return response()->json([
                'status' => true,
                'msg' => 'Order placed successfully using credit',
                'url' => route('front.order-thanks-page', $ord_phn),
            ], 200);
        } elseif ($paymentMethod === 'stripe') {
            return response()->json([
                'status' => true,
                'msg' => 'Redirecting to Stripe',
                'url' => route('stripe.index', [$order->id]),
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'msg' => 'Order placed successfully',
                'url' => route('front.order-thanks-page', $ord_phn),
            ], 200);
        }
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => false,
            'msg' => $e->getMessage(),
        ]);
    }
}

    

    

    public function storelandData(Request $request)
    {
        // dd($request->all());
        $inputs = $request->validate([
            'billing_name' => '',
            'billing_email' => '',
            'billing_phone' => '',
            'billing_address' => '',
            'billing_country' => '',
            'billing_state' => '',
            'billing_city' => '',
            'billing_address_type' => '',
            'shipping_name' => '',
            'shipping_email' => '',
            'shipping_phone' => '',
            'shipping_address' => '',
            'shipping_country' => '',
            'shipping_state' => '',
            'shipping_city' => '',
            'shipping_address_type' => '',
            'payment_method' => '',
            'shipping_method' => '',
            'transection_id' => ''
        ]);







        $user = Auth::user();
        $checkinguser = User::where('phone', $inputs['shipping_phone'])->first();



        if($checkinguser == null) {

                   $ord_phn = $user->phone;
                } else {
                   $ord_phn = $checkinguser->phone;
                }

        if($user == null)
        {
            $user = User::create([
                'name'  =>   $inputs['shipping_name'],
                'email'  =>   $inputs['shipping_email'],

                'phone'  =>   $inputs['shipping_phone'],
                'address'  =>   $inputs['shipping_address'],
            ]);
        }

        $shipping_rule = Shipping::find($inputs['shipping_method'])->shipping_rule;
        $shipping_id = $inputs['shipping_method'];

        $couponCode = isset($coupon['code']) ? $coupon['code'] : null;
        $total = $this->calculateCartTotal(
            $user,
            1235,
            $shipping_id
        );

        $data = [];
        $data['order_id'] = rand(100, 10000);

        $data['user_id'] =  $user->id;
        $data['product_qty'] = $request->product_qty;
        $data['payment_method'] = $request->payment_method;
        $data['shipping_method'] = $shipping_rule;
        $data['ordered_delivery_date'] = $request->ordered_delivery_date;
        $data['ordered_delivery_time'] = $request->ordered_delivery_time;
        $data['total_amount'] = $request->total_amount;
        // $data['coupon_coast'] = $total["coupon_price"];
        // $data['shipping_cost'] = $total["shipping_fee"];
        $data['order_status'] = 0;
        $data['cash_on_delivery'] = 0;
        $data['additional_info'] = 0;
        $data['assign_id'] = User::inRandomOrder()->first()->id;

        // Order Assign Among Users Start

        $usrs = DB::table('model_has_roles')->where('role_id', 20)->get();
        $verified_users = [];

        foreach($usrs as $user) {
           $test = DB::table('users')->where('id', $user->model_id)->first();

            if ($test->status == 2) {
                $verified_users[] = $user->model_id;
            }
        }

        $keyValue = array_rand($verified_users);
        $data['assign_user_id'] = $verified_users[$keyValue];


        // Order Assign Among Users End.
        try{
            DB::beginTransaction();
            $order = Order::create($data);
            if($order)
            {
                $cart = session()->get('cart', []);
                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $request->product_id,
                        'seller_id' => 0,
                        'product_name' => $request['product_name'],
                        'unit_price' => $request['price'],
                        'qty' => $request->product_qty,
                        'variation_color_id' => $request->variation_color_id,
                        'variation' => $request->variation
                    ]);


                //    $single_product = Product::find($orderProduct->product_id);
                //    $single_product->sold_qty = $orderProduct;
                   $orderProduct->save();


                $order->orderAddress()->create([
                    'billing_name' =>  $request->billing_name,
                    'billing_email' => $request->billing_email,
                    'billing_phone' =>  $request->billing_phone,
                    'billing_address' =>  $request->billing_address,
                    'billing_country' =>  $request->billing_country,
                    'billing_state' =>  $request->billing_state,
                    'billing_city' =>  $request->billing_city,
                    'billing_address_type' =>  $request->billing_address_type,
                    'shipping_name' => $request->shipping_name,
                    'shipping_email' => $request->shipping_email,
                    'shipping_phone' =>  $request->shipping_phone,
                    'shipping_address' =>  $request->shipping_address,
                    'shipping_country' =>  $request->shipping_country,
                    'shipping_state' =>  $request->shipping_state,
                    'shipping_city' =>  $request->shipping_city,
                    'shipping_address_type' =>  $request->shipping_address_type,
                    'payment_method' => $request->payment_method,
                    'shipping_method' => $request->shipping_method,
                    'transection_id' => $request->transection_id,
                ]);

            }

            DB::commit();

            session()->put('cart', []);
            session()->put('coupon', []);

            return response()->json([
                'success' => true,
                'msg' => 'Order placed successfully',
                'url' => route('front.order-thanks-page',$ord_phn)
            ], 200);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage(),
            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stateByCountry($id){
        $states = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $html = "<option value=''>Please Select One</option>";
        foreach($states as $state)
        {
            $html .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json(['states'=>$states, 'html' => $html]);
    }

    public function cityByState($id){
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $html = "<option value=''>Please Select One</option>";
        foreach($cities as $city)
        {
            $html .= "<option value='".$city->id."'>".$city->name."</option>";
        }

        return response()->json(['cities'=>$cities, 'html' => $html]);
    }

    public function calculateCartTotal(
        $user,
        $request_coupon,
        $request_shipping_method_id
    )

    {
        $total_price = 0;
        $coupon_price = 0;
        $shipping_fee = 0;
        $productWeight = 0;

        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            $notification = trans("Your shopping cart is empty");

            return response()->json(["status"=>false, "msg" => $notification]);
        }

        foreach ($cart as $index => $cartProduct) {
            $variantPrice = 0;

            if (!empty($cartProduct['variation'])) {
                    $item = ProductVariant::find(
                        $cartProduct['variation']
                    );

                    if ($item) {
                        $variantPrice = $item->sell_price;
                    }
                }

            $product = Product::select(
                "id",
                "price",
                "offer_price",
                "weight"
            )->find($cartProduct['product_id']);

            $price = $product->offer_price
                ? $product->offer_price
                : $product->price;

            $price = $variantPrice > 0 ? $variantPrice : $price;
            $weight = $product->weight;
            $weight = $weight * $cartProduct['quantity'];
            $productWeight += $weight;
            $isFlashSale = FlashSaleProduct::where([
                "product_id" => $product->id,
                "status" => 1,
            ])->first();

            $today = date("Y-m-d H:i:s");

            if ($isFlashSale) {
                $flashSale = FlashSale::first();
                if ($flashSale->status == 1) {
                    if ($today <= $flashSale->end_time) {
                        $offerPrice = ($flashSale->offer / 100) * $price;
                        $price = $price - $offerPrice;
                    }
                }
            }

            $price = $price * $cartProduct['quantity'];
            $total_price += $price;

        }


        // calculate coupon coast

        if ($request_coupon) {
            $coupon = Coupon::where([
                "code" => $request_coupon,
                "status" => 1,
            ])->first();

            if ($coupon) {
                if ($coupon->expired_date >= date("Y-m-d")) {
                    if ($coupon->apply_qty < $coupon->max_quantity) {
                        if ($coupon->offer_type == 1) {
                            $couponAmount = $coupon->discount;

                            $couponAmount =
                                ($couponAmount / 100) * $total_price;
                        } elseif ($coupon->offer_type == 2) {
                            $couponAmount = $coupon->discount;
                        }

                        $coupon_price = $couponAmount;
                        $qty = $coupon->apply_qty;
                        $qty = $qty + 1;
                        $coupon->apply_qty = $qty;
                        $coupon->save();
                    }
                }
            }

        }

        $shipping = Shipping::find($request_shipping_method_id);

        if (!$shipping) {
            return response()->json(
                ["message" => trans("Shipping method not found")],
                403
            );
        }

        if ($shipping->shipping_fee == 0) {
            $shipping_fee = 0;
        } else {
            $shipping_fee = $shipping->shipping_fee;
        }

        $total_price = $total_price - $coupon_price + $shipping_fee;

        $total_price = str_replace(
            ['\'', '"', ",", ";", "<", ">"],
            "",
            $total_price
        );

        $total_price = number_format($total_price, 2, ".", "");

        $arr = [];
        $arr["total_price"] = $total_price;
        $arr["coupon_price"] = $coupon_price;
        $arr["shipping_fee"] = $shipping_fee;
        $arr["shipping"] = $shipping;
        return $arr;
}

}
