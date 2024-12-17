@extends('frontend.app')
@section('title', 'Shop Product List')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/silck/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}

@endpush
@section('content')
<section class="container mx-auto my-4 lg:my-10 px-4">
    <h2 class="text-2xl lg:text-4xl font-extrabold text-gray-800 mb-10 text-center relative">
        @if(!empty($services[0]->category))
            {{ $services[0]->category->name }}
        @endif
        @if(!empty($services[0]->subCategory))
            /{{ $services[0]->subCategory->name }}
        @endif
        @if(!empty($services[0]->childCategory))
            /{{ $services[0]->childCategory->name }}
        @endif
        <span class="absolute inset-x-0 -bottom-4 h-1 bg-blue-800 rounded-md transform scale-x-50 transition-transform duration-300 origin-center"></span>
     </h2>
     
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
     
        <!-- Product Card 1 -->
        @forelse ($services as $key => $product)
   <div class="border border-gray-300 rounded-lg p-4 shadow-sm flex flex-col items-center text-center">
      <a href="{{ route('front.product.show', [ $product->id ] ) }}">
         <img
           src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}"
           alt="Charging Port Flex Cable"
           class="w-full h-32 object-contain mb-4 rounded"
         />
         <h3 class="text-sm lg:text-lg font-semibold text-gray-800">
           {{ \Illuminate\Support\Str::limit($product->name, 60, '...') }}
         </h3>
      </a>
      @if(empty($product->offer_price))
         <p class="text-2xl font-bold text-gray-900 my-2 current_price">${{$product->price}}</p>
      @else
         <p class="text-2xl font-bold text-gray-900 my-2 current_price">${{$product->offer_price}}</p>
         <del class="old_price">${{$product->price}} </del>
      @endif
      <a href="{{ route('front.check.single', ['product_id' => $product->id]) }}"
         class="mt-4 w-full bg-blue-800 text-white py-2 rounded-md hover:bg-blue-600 transition buy-now"
         data-url="{{ route('front.cart.store') }}"
      >
         Add to Cart
      </a>
   </div>
@empty
   <p class="text-center col-span-full">No products available</p>
@endforelse

     
     
    </div>
  </section>
@endsection

@push('js')
<script>
$(document).ready(function () {

    $(document).on('click', '.add-to-cart', function (e) {
        let id = $(this).data('id');
        let url = $(this).data('url');
        addToCart(url, id);
    });

    // ... other click event handlers ...

    function addToCart(url, id, variation = "", quantity = 1) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: { id, quantity, variation},
            success: function (res) {
                if (res.status) {
                        //  toastr.success(res.msg);
                         window.location.reload();

                } else {
                    toastr.error(res.msg);
                }
            },
            error: function (xhr, status, error) {
                toastr.error('An error occurred while processing your request.');
            }
        });
    }

    $('.buy-now').on('click', function (e) {
        e.preventDefault();

        var productId = $(this).attr('href').split('/').pop();
        var proQty = 1;
        var addToCartUrl = $(this).data('url');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Include CSRF token in AJAX request headers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Perform AJAX request to add the product to the cart
        $.post(addToCartUrl, { id: productId, quantity: proQty }, function (response) {
            // toastr.success(response.msg);
            if(response.status)
            {
                // Redirect to checkout page after adding to cart
                window.location.href = "{{ route('front.checkout.index') }}";
            } else
            {

            }

        });
    });
});
</script>

<script>


</script>


@endpush

