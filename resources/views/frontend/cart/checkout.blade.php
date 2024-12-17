@extends('frontend.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
@endpush
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}


<div class="main-wrapper " style="display: none">
    <div class="overlay-sidebar"></div>
    <div class="container">
        <section>
            <div class="container-fluid mt-5 mb-5">
                <div class="row flex-lg-row-reverse">
                    <div id="order_info" class="col-lg-6">

                        <div class="card text-center">
  <div class="card-header">
  {{ BanglaText('order_information') }}
  </div>
  <div class="card-body">
      <div class="table-responsive">
    <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th></th>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Product Price</th>

                            </tr>
                          </thead>
                          <tbody>
                              @php $sub_total = 0; @endphp
                        @forelse($cart as $key => $item)
                            <tr>
                              <td>
                                    <div class="remove">
                                        <button class="btn remove-item" data-id="{{ $key }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                              <th scope="row"><img src="{{ asset('uploads/custom-images2/'.$item['image']) }}" alt="" class="rounded border" style="height: 60px;width: 60px;" width=""></th>
                              <td>{{ Str::limit($item['name'], 15) }}</td>
                              <td>
                                    <div class="quantity d-flex">
                                        <button class="btn rounded-0 border border-muted dec" data-id="{{ $key }}">-</button>
                                        <input type="number" style="width: 45px;"  min="1" class="border border-muted text-center rounded-0 quantity-value" value="{{ $item['quantity'] }}" data-id="{{ $key }}" required>
                                        <button class="btn rounded-0 border border-muted inc" data-id="{{ $key }}">+</button>
                                    </div>
                                </td>
                              <td>{{ $item['price'] }}</td>
                            </tr>
                             @php $sub_total += $item['quantity'] * $item['price']; @endphp
                             @empty
                        @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Subtotal</td>
                                <td>{{ number_format($sub_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Shipping</td>
                                <td><p id="shipping_value">0.00 </p></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>
                                <p id="total_amount">{{ number_format($sub_total, 2) }} ৳</p>
                                <input type="hidden" name="total_amount" id="total_amount" value="{{ number_format($sub_total, 2) }}">
                                </td>
                            </tr>
                          </tbody>
                        </table>
    </div>
  </div>
  <div class="card-footer text-muted">
    <div class="table-responsive">
      <table class="table table-bordered">

      <tbody>
        <tr>
            @guest
            <td>
          <div class="d-flex justify-content-between align-item-conter al_btn">
                              <p class="login_text" style="font-size: 14px;">{{ BanglaText('login_account') }}  <a style="font-size: 11px; background: #9d0303" class="btn btn-success" href="{{url('login-user')}}" class="text-muted text-decoration-none icon-signin">Login</a></p>

               </div>
               </td>
          <td>
         @endguest
               {{-- <div id="coupon-toggle" style="font-size: 12px;background: #03259D;color: #ffffff;" class="btn">{{BanglaText('coupon_apply') }}</div> --}}
               <div class="row" id="coupon-form" style="display: none;">
              <form action="{{ route('front.cart.apply-coupon') }}" method="post" id="coupon_form">
                  @csrf
                  <div class="col-lg-12 col-12 mb-2 mt-2 form-floating">
                      <input type="text" class="form-control shadow-none" name="code" id="code" value="" placeholder="Enter Your Coupon Code">
                      <input type="hidden" name="shipping_id" id="shipping_id" value="">
                      <label for="code" class="ps-4">Apply Coupon</label>
                  </div>
                  <div class="">
                      <button type="submit" class="btn text-light" style="font-family: 'Kalpurush', sans-serif;background: #03259D !important;">Apply Coupon<i class="fas fa-arrow-right"></i></button>
                  </div>
              </form>
          </div>
          </td>
        </tr>

      </tbody>
    </table>
</div>
  </div>
</div>




                        <!--@php $sub_total = 0; @endphp-->
                        <!--@forelse($cart as $key => $item)-->
                        <!--    <div class="d-flex justify-content-between align-item-center checkout-product-details">-->
                        <!--        <div class="d-flex align-item-center">-->
                        <!--            <div class="image">-->
                        <!--                <img src="{{ asset('uploads/custom-images2/'.$item['image']) }}" alt="" class="rounded border" style="height: 60px;width: 60px;" width="">-->
                        <!--                <span class="badge bg-primary rounded-circle" style="height: 20px; position: absolute;">1</span>-->
                        <!--            </div>-->
                        <!--            <div class="name ps-4">-->
                        <!--                <span class="pr_name">{{ Str::limit($item['name'], 15) }}</span>-->
                        <!--            </div>-->

                        <!--        </div>-->
                        <!--        <div class="price">-->
                        <!--            <p>{{ $item['price'] }}৳</p>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--  @php $sub_total += $item['quantity'] * $item['price']; @endphp-->
                        <!--@empty-->
                        <!--    <div align="center">-->
                        <!--        <strong class="text-center text-danger">No Data</strong>-->
                        <!--    </div>-->
                        <!--@endforelse-->

                        <!--<hr>-->
                        <!--<div class="checkout-product-price" style="">-->
                        <!--    <div class="d-flex justify-content-between">-->
                        <!--        <p>Subtotal</p>-->
                        <!--        <p>{{ number_format($sub_total, 2) }} </p>-->
                        <!--    </div>-->
                        <!--    <div class="d-flex justify-content-between">-->
                        <!--        <p>Shipping</p>-->
                        <!--        <p id="shipping_value">0.00 </p>-->
                        <!--    </div>-->
                        <!--    <hr>-->
                        <!--    <div class="d-flex justify-content-between">-->
                        <!--        <h5>Total</h5>-->
                        <!--        <p id="total_amount">{{ number_format($sub_total, 2) }} ৳</p>-->
                        <!--        <input type="hidden" name="total_amount" id="total_amount" value="{{ number_format($sub_total, 2) }}">-->

                        <!--    </div>-->
                        <!--</div>-->

                    </div>
                    <div id="data_info" class="col-lg-6">

                      <div class="card text-center">
  <div class="card-header">
   <h3 class="bold-9" style="font-size: 16px;font-family: 'Kalpurush', sans-serif;">
                        {{ BanglaText('instruction') }}
                        </h3>
  </div>
  <div class="card-body">




                        <!--<div class="d-flex justify-content-between align-item-conter">-->
                        <!--    <h5>Contact Information</h5>-->
                        <!--    <p>Already have an account <a href="#" class="text-muted text-decoration-none icon-signin">Login</a></p>-->
                        <!--</div>-->
                        <form action="">
                            <!--<div class="mb-3">-->
                            <!--    <input type="text" class="form-control shadow-none" name="billing_email" placeholder="Email or mobile phone number">-->
                            <!--    <div class="form-check mt-2">-->
                            <!--      <input class="form-check-input" type="checkbox" value="" id="email-info">-->
                            <!--      <label class="form-check-label text-muted" for="email-info">-->
                            <!--        Email me with news and offers-->
                            <!--      </label>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </form>

                        <form action="{{ route('front.checkout.store') }}" method="POST" id="checkoutForm">
                            @csrf
                          	<input type="hidden" name=""/>

                            <div class="row">
                                <b><u>Shipping Informations</u></b>
                                <div class="col-lg-12 col-12 mb-3 form-floating">
                                      <input type="text" class="form-control shadow-none" name="shipping_name" id="name" value="{{ $user ? $user->name : '' }}" placeholder="Name">
                                      <label for="name" class="ps-4">{{ BanglaText('name') }}</label>
                                </div>
								<input type="hidden" name="variation_color_id" value="{{$item['variation_color']}}" />

                              	<div class="form-group col-sm-12">

                                    <input type="hidden" name="ip_address" id="ip_address" value="">
                                </div>

                                <div class="col-lg-12 col-12 mb-3 form-floating">
                                <input type="text" class="form-control shadow-none" name="order_phone" value="{{ $user ? $user->phone : '' }}" id="phone" placeholder="Enter Phone Number" aria-describedby="phone-help">
                                <label for="phone" class="ps-4">
                                 {{ BanglaText('mobile') }}
                                </label>

                              </div>

                              </div>

                                <div class="row">

                                </div>

                            <div class="row">
                                <div class="col-lg-12 col-12 mb-3 form-floating">
                                      <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-none" name="shipping_address" value="{{ $user ? $user->address : '' }}" id="address" placeholder="Address">
                                <label for="address">
                                    {{ BanglaText('address') }}
                                </label>
                              </div>
                                </div>


                            </div>
                            <u for=""> <b>Shipping Method</b>  </u>

                              <?php

                                     $shipping_value = [];

                                     foreach($cart as $key=>$item) {
                                       $shipping_value[] = $item['is_free_shipping'];
                                     }

                                   if(in_array(null, $shipping_value)) {
                                         ?>

                            		<div class="form-floating mb-3">

                                @foreach($shippings as $key=>$shipping)
                                      @if($shipping->id != '25')
                                       <div class="input-group" style="margin-bottom: 25px;">
                                          <input selected type="radio" value="{{ $shipping->id}}" class="charge_radio delivery_charge_id" id="ship_{{ $shipping->id}}" data-shippingid="{{ $shipping->id }}" name="shipping_method" data-shipping="{{ $shipping->shipping_fee}}"> &nbsp;&nbsp;
                                            <label for="ship_{{ $shipping->id}}">{{ $shipping->shipping_rule}} </label>
                                       </div>
                                      @else
                                      @endif
                                    @endforeach
                              </div>

                              <?php
                                     } else {
                                         ?>
												@php
                                         $free_shippings = DB::table('shippings')->where('id', 25)->first();
                                         @endphp
                                          <div class="input-group" style="margin-bottom: 25px;">
                                          <input checked selected type="radio" value="{{ $free_shippings->id}}" class="charge_radio delivery_charge_id" id="ship_{{ $free_shippings->id}}" data-shippingid="{{ $free_shippings->id }}" name="shipping_method" data-shipping="{{ $free_shippings->shipping_fee}}"> &nbsp;&nbsp;
                                            <label for="ship_{{ $free_shippings->id}}">{{ $free_shippings->shipping_rule}} - {{ $free_shippings->shipping_fee }}{{ $setting->currency_icon }}</label>
                                            </div>

                                         <?php
                                     }

                                   ?>
                        <input type="hidden" name="total_amount" id="total_amount" value="{{ number_format($sub_total, 2) }}">

                        <div class="card mb-3">
                            <div class="card-header">Payment Method</div>
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="stripeOption" value="stripe" required>
                                    <label class="form-check-label" for="stripeOption">Stripe</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="creditOption" value="credit_payment" required>
                                    <label class="form-check-label" for="creditOption">Credit</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" required>
                                    <label class="form-check-label" for="cash_on_delivery">Cash on Delivery </label>
                                </div>
                                <div id="creditInfo" class="text-danger d-none">
                                    <small>Note: Your current credit balance is $<span id="creditBalance">{{ $user->credit ?? 0 }}</span>.</small>
                                </div>
                            </div>
                        </div>

                            <!--  <div class="form-floating mb-3">-->
                            <!--    <select name="payment_method" class="form-select shadow-none" id="">-->
                            <!--        <option value="cash_on_delivery">Cash On Delivery</option>-->
                            <!--        <option value="card">Bank Order</option>-->
                            <!--    </select>-->
                            <!--  <label for="country">Payment Method</label>-->
                            <!--</div>-->

                              <!--<div class="form-check mt-2">-->
                              <!--  <input class="form-check-input" type="checkbox" value="" id="save-info">-->
                              <!--  <label class="form-check-label text-muted" for="save-info">-->
                              <!--    Save this Information for next time-->
                              <!--  </label>-->
                              <!--</div>-->
                              <!--<div class="d-flex justify-content-between mt-3">-->
                              <!--  <a href="{{ route('front.cart.index')}}" style="padding-left: 0px;" class="btn"><i class="fas fa-repeat"></i> Return to cart</a>-->
                              <!--</div>-->
                              <button type="submit" class="btn bg-blue text-light" style="font-family: 'Kalpurush', sans-serif;width: 100%;height: 50px;font-size: 20px;background: #9d0303 !important;">{{ BanglaText('confirm_order') }} <i class="fas fa-arrow-right"></i></button>


                        </form>

                       <!-- Button or text to trigger the coupon form -->


          <!-- Coupon form (initially hidden) -->

                        </div>
                    </div>
                </div>
            </div>


        </section>


    </div>

</div>


<main>
    <section
      class="max-w-6xl mx-auto my-2 lg:my-8 p-4 lg:p-8 bg-gray-50 rounded-lg shadow-lg"
    >
      <h2
        class="text-3xl font-bold mb-6 text-gray-800 text-center lg:text-left"
      >
        Checkout
      </h2>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Billing Details Section -->
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            Billing Details
          </h3>
          <form class="space-y-4" action="{{ route('front.checkout.store') }}" method="POST" id="checkoutForm">
            @csrf
                            <input type="hidden" name=""/>
            <input type="hidden" name="ip_address" id="ip_address" value="">
            <div class="grid grid-cols-1 ">
              <div>
                <label class="block text-gray-700 text-sm mb-2"
                  >Full Name</label
                >
                <input
                  type="text"
                  class="w-full border rounded-lg px-3 py-2"
                  name="shipping_name" id="name" value="{{ $user ? $user->name : '' }}"
                  placeholder="John"
                />
              </div>
              
            </div>
            <div>
              <label class="block text-gray-700 text-sm mb-2"
                >Email Address</label
              >
              <input
                type="email"
                class="w-full border rounded-lg px-3 py-2"
                 name="shipping_email" id="email" value="{{ $user ? $user->email : '' }}"
                placeholder="johndoe@example.com"
              />
            </div>
            <div>
              <label class="block text-gray-700 text-sm mb-2"
                >Phone Number</label
              >
              <input
                type="tel"
                class="w-full border rounded-lg px-3 py-2"
                name="order_phone" value="{{ $user ? $user->phone : '' }}" id="phone" 
                placeholder="+123 456 7890"
              />
            </div>
            <div>
              <label class="block text-gray-700 text-sm mb-2">Address</label>
              <input
                type="text"
                class="w-full border rounded-lg px-3 py-2"
                name="shipping_address" value="{{ $user ? $user->address : '' }}" id="address"
                placeholder="123 Main St"
              />
            </div>
            <div class="mt-6">
              <label class="block text-gray-700 text-sm font-semibold mb-4">Shipping Method</label>
              <?php

                $shipping_value = [];

                foreach($cart as $key=>$item) {
                $shipping_value[] = $item['is_free_shipping'];
                }

                if(in_array(null, $shipping_value)) {
                    ?>
                <div class="flex space-x-4">
                @foreach($shippings as $key=>$shipping)
                @if($shipping->id != '25')
              
                <!-- FedEx Shipping Option -->
                <label class="flex items-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer transition hover:bg-gray-100 focus-within:border-blue-500">
                  <input
                    type="radio"
                    
                    value="{{ $shipping->id}}"
                    class="form-radio h-5 w-5 text-blue-500 charge_radio delivery_charge_id"
                    id="ship_{{ $shipping->id}}" data-shippingid="{{ $shipping->id }}" name="shipping_method" data-shipping="{{ $shipping->shipping_fee}}"
                  />
                  <span class="ml-2 text-gray-800 font-medium">{{ $shipping->shipping_rule}} </span>
                </label>
            

              
              @else
              @endif
            @endforeach
        </div>
            </div>
            <?php
                } else {
                    
                
                    ?>
                    <p>no shipping</p>
                    <?php } ?>

        <input type="hidden" name="total_amount" id="total_amount" value="{{ number_format($sub_total, 2) }}">
        <div class="mt-6">
            <label class="block text-gray-700 text-sm font-semibold mb-4">Payment Method</label>
            <div class="flex space-x-4">
             
              <label class="flex items-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer transition hover:bg-gray-100 focus-within:border-blue-500">
                <input
                  type="radio"
                  name="payment_method" id="stripeOption" value="stripe" required
                  class="form-radio h-5 w-5 text-blue-500"
                />
                <span class="ml-2 text-gray-800 font-medium">Pay with Stripe</span>
              </label>
          
              <!-- UPS Shipping Option -->
              <label for="creditOption" class="flex items-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer transition hover:bg-gray-100 focus-within:border-blue-500">
                <input
                  type="radio"
                  name="payment_method" id="creditOption" value="credit_payment" required
                  class="form-radio h-5 w-5 text-blue-500"
                />
                <span class="ml-2 text-gray-800 font-medium">Internal Credit</span>
              </label>
          
              

              <label for="due" class="flex items-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer transition hover:bg-gray-100 focus-within:border-blue-500">
                <input
                  type="radio"
                  name="payment_method" id="due" value="due" required
                  class="form-radio h-5 w-5 text-blue-500"
                />
                <span class="ml-2 text-gray-800 font-medium">Due</span>
              </label>

              <!-- USPS Shipping Option -->
              <label class="flex items-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer transition hover:bg-gray-100 focus-within:border-blue-500">
                <input
                  type="radio"
                  name="payment_method" id="cash_on_delivery" value="cash_on_delivery" required
                  class="form-radio h-5 w-5 text-blue-500"
                />
                <span class="ml-2 text-gray-800 font-medium">Cash ON Delivery</span>
              </label>
              <div id="creditInfo" class="ml-2 text-red-800 d-none">
                <small>Note: Your current credit balance is $<span id="creditBalance">{{ $user->credit ?? 0 }}</span>.</small>
            </div>
            </div>
          </div>            
          
        </div>

        <!-- Order Summary Section -->
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            Order Summary
          </h3>
          <div class="bg-white p-4 rounded-lg shadow-md space-y-4">
            <!-- List of Products -->
            @forelse($cart as $key => $item)
            <div class="flex items-center justify-between border-b pb-4">
                
                <div class="flex items-center space-x-4">
                <img
                  src="{{ asset('uploads/custom-images2/'.$item['image']) }}"
                  alt="Product 1"
                  class="w-16 h-16 object-cover rounded-md"
                />
                
                <div>
                  <h4 class="text-gray-800 font-semibold">{{ Str::limit($item['name'], 15) }}</h4>
                  <p class="text-gray-600 text-sm">Qty: {{ $item['quantity'] }}</p>
                </div>
               
              </div>
              
              <p class="text-gray-800 font-semibold">${{ $item['price'] }}</p>
            </div>
            @empty
            @endforelse
            <!-- Repeat for other products -->

            <!-- Price Details -->
            <div class="space-y-2">
              <div class="flex justify-between text-gray-800">
                <p>Subtotal:</p>
                <p>${{ number_format($sub_total, 2) }}</p>
              </div>
              <div class="flex justify-between text-gray-800">
                <p>Shipping:</p>
                <p id="shipping_value">$0.00</p>
              </div>
              <div
                class="flex justify-between text-xl font-bold text-gray-800"
              >
                <p >Total:</p>
                <p id="total_amount">${{ number_format($sub_total, 2) }}</p>
              </div>
            </div>
            <!-- Place Order Button triggers the modal on click -->
            
            <button
            type="submit"
              
              class="w-full bg-red-600 text-white py-2 rounded-md font-semibold hover:bg-black transition"
            >
              Place Order
            </button>
        </form>
          </div>
        </div>
      </div>
      <!-- Thank You Modal (Initially Hidden) -->
      <div
        id="thankYouModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
        style="display: none"
      >
        <div class="bg-white rounded-lg p-6 text-center shadow-lg">
          <h2 class="text-2xl font-bold text-gray-800 mb-4">Thank You!</h2>
          <p class="text-gray-600">
            Your order has been placed successfully.
          </p>
        </div>
      </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const creditOption = document.getElementById('creditOption');
        const creditInfo = document.getElementById('creditInfo');

        // Show credit balance warning if "Credit" is selected
        creditOption.addEventListener('change', () => {
            if (creditOption.checked) {
                creditInfo.classList.remove('d-none');
            }
        });

        // Hide credit balance warning if "Stripe" is selected
        document.getElementById('stripeOption').addEventListener('change', () => {
            creditInfo.classList.add('d-none');
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @endsection

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    // Toggle coupon form visibility on button click
    $("#coupon-toggle").click(function() {
        $("#coupon-form").toggle();
    });
});
</script>


<script>
    // Fetch user's IP address using a third-party API
    fetch('https://api64.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            document.getElementById('ip_address').value = data.ip;
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
        });
</script>


<script type="text/javascript">

// document.addEventListener("DOMContentLoaded", function () {
//   // Your code here
//   const myDiv = document.getElementById("data_info");
//   const myDiv2 = document.getElementById("order_info");
//   window.addEventListener("resize", function () {
//         if (window.innerWidth <= 768) {
//             myDiv.classList.add("order-1");
//             myDiv2.classList.add("order-2");
//         } else {
//           myDiv.classList.remove("order-1");
//           myDiv2.classList.remove("order-2");
//     }
//   });
// });

    $(document).ready(function () {

  		$('.charge_radio').click(function(){
          getCharge();
        // alert('hi');
        });

        function getCharge(){getCharge

            var testval = $('input:radio:checked.charge_radio').map(function(){
                return Number($(this).data('shipping')); }).get().join(",");
            var shipping_id = $('input:radio:checked.charge_radio').val();
            $('#shipping_id').val(shipping_id);
            $('p#shipping_value').text(testval);
            let sub_total = '{{cartTotalAmount()['total']}}';
            let total=Number(testval)+Number(sub_total);
            $('p#total_amount').text(total.toFixed(2));

        }

    $(document).on('submit', 'form#coupon_form', function(e){
        e.preventDefault();
        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let data = $(this).serialize();
        $.ajax({
            type: method,
            url:  url,
            data: data,
            success : function(res) {
                if(res.status == true)
                {
                    $('p#total_amount').text(res.total_price);
                    // alert(res.total_price);
                    // $('p#total_amount').text('sg');
                    // res.total_price.toFixed(2);
                }
            }
        });
    });

    $(document).on('submit', 'form#checkoutForm', function(e){
  	e.preventDefault();
    $('span.error').text('');
    let url = $(this).attr('action');
    let method = $(this).attr('method');
    let data =$(this).serialize();
    $.ajax({
      type:method,
      url:url,
      data:data,
      success: function(res)
      {
        if(res.status)
        {
          toastr.success(res.msg);
          if(res.url)
          {
              document.location.href = res.url;
          }
          else{
             // $('#optver').modal('show');
             window.location.reload();
          }
        }
        else{
          toastr.error(res.msg);
        }
      },
      error: function(response)
      {
        $.each(response.responseJSON.errors, function(name, error){
          $(document).find('[name='+name+']').closest('div').after('<span class="error text-danger">'+error+'</span>');
          toastr.error(error);
        });
      }
    });

  });

  });

 </script>

