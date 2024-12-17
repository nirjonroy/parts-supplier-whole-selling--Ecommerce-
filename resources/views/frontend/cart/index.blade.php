@extends('frontend.app')
@section('title', 'Home')
@push('css')

<link rel="stylesheet" href="{{asset('frontend/assets/css/cart.css')}}">
@endpush
@section('content')
@php
$totalAmount = 0;
@endphp
<section
        class="max-w-5xl mx-auto my-4 lg:my-8 p-4 lg:p-8 bg-gray-50 rounded-lg shadow-lg"
      >
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h2>

        <!-- Cart Items Section -->
        <div class="space-y-4">
          <!-- Individual Product in Cart -->
          @forelse($cart as $key => $item)
          <div class="flex items-center border-b pb-4">
            <img
              src="{{ asset('uploads/custom-images2/'.$item['image']) }}"
              alt="Product 1"
              class="w-20 h-20 object-contain rounded-md mr-4"
            />
            <div
              class="w-full flex-col lg:flex-row flex justify-between lg:items-start items-center"
            >
              <div>
                <h3 class="text-lg font-semibold text-gray-800">
                    {{ $item['name'] }}
                </h3>
                
              </div>
              <div class="flex items-center space-x-4">
                <div
                  class="flex items-center border border-gray-300 rounded-md"
                >
                  <button class="px-2 py-1 text-gray-600 dec" data-id="{{ $key }}">-</button>
                  <input
                    type="number"
                   
                    min="1"
                    class="w-12 text-center border-0 quantity-value" value="{{ $item['quantity'] }}" data-id="{{ $key }}"
                  />
                  <button class="px-2 py-1 text-gray-600 inc" data-id="{{ $key }}">+</button>
                  
                  

                </div>
                <div class="subtotal" id="subtotal-{{ $key }}" data-price="{{ $item['price'] }}">
                    <div class="subtotal" title="subtotal">
                        <p class="text-lg font-semibold text-gray-800 product-price" data-title="Price">${{ number_format($item['quantity'] * $item['price'], 2) }}</p>
                    </div>
                </div>
                
                <button class="text-red-500 hover:text-red-700 remove-item" data-id="{{ $key }}">Remove</button>
              </div>
            </div>
          </div>
          @php
                            $totalAmount += ($item['price'] * $item['quantity']); // Calculate totalAmount
                            @endphp
          @empty
                            <div align="center">
                                <strong class="text-center text-danger">No Data</strong>
                            </div>
                            @endforelse
          <!-- Individual Product in Cart -->
         

          <!-- Continue with more product cards as needed -->
        </div>

        <!-- Cart Total Section -->
        <div class="flex justify-end mt-8">
          <div class="w-full lg:w-1/3 bg-white p-4 rounded-lg shadow-md">
           
            <div class="border-t border-gray-200 pt-4">
              <div class="flex justify-between items-center">
                <p class="text-xl font-bold text-gray-800">Total:</p>
                <p class="text-xl font-bold text-gray-800">${{ $totalAmount }}</p>
              </div>
              <button
                onclick="window.location.href='{{ route('front.checkout.index') }}'"
                class="w-full mt-6 bg-red-600 text-white py-2 rounded-md font-semibold hover:bg-black transition"
              >
                Proceed to Checkout
              </button>

              
            </div>
          </div>
        </div>
      </section>

@endsection

