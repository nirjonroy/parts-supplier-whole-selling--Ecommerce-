@extends('frontend.app')
@section('title', 'Shop Product List')
@push('css')

@endpush
@section('content')
<main>
    <section class="container mx-auto my-4 lg:my-10 px-4">
      <h2
        class="text-2xl lg:text-4xl font-extrabold text-gray-800 mb-10 text-center relative"
      >
        <span class="block">           @if(!empty($products[0]->category))
          {{ $products[0]->category->name }}
      @endif
      @if(!empty($products[0]->subCategory))
      > {{ $products[0]->subCategory->name }}
      @endif
      @if(!empty($products[0]->childCategory))
      > {{ $products[0]->childCategory->name }}
      @endif</span>
        <span
          class="absolute inset-x-0 -bottom-4 h-1 bg-blue-800 rounded-md transform scale-x-50 transition-transform duration-300 origin-center"
        ></span>
      </h2>
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
        <!-- Product Card 1 -->
        @forelse($products  as $key => $product)
        <div
            class="border border-gray-300 rounded-lg p-4 shadow-sm flex flex-col items-center text-center"
          >
        <a href="{{ route('front.product.show', [ $product->id ] ) }}">
          <div
            class="border border-gray-300 rounded-lg p-4 shadow-sm flex flex-col items-center text-center"
          >
            <img
              src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}"
              alt="Charging Port Flex Cable"
              class="w-full h-32 object-contain mb-4 rounded"
            />
            <h3 class="text-sm lg:text-lg font-semibold text-gray-800">
              {{ \Illuminate\Support\Str::limit($product->name, 30)}}
            </h3>
            @if(empty($product->offer_price))
            <p class="text-2xl font-bold text-gray-900 my-2">${{ $product->price }}</p>
            @else
            <p class="text-2xl font-bold text-gray-900 my-2">${{ $product->offer_price }}</p>
            <p class="text-2xl font-bold text-gray-900 my-2">${{ $product->price }}</p>
            @endif


            @if($product->type == 'variable' || $product->prod_color == 'varcolor')
            <a href="{{ route('front.product.show', [ $product->id ] ) }}"
                           
                           class="mt-4 w-full bg-blue-800 text-white py-2 rounded-md hover:bg-blue-600 transition "
                           >
                       Order
                        </a>

          @else

          <a href="{{ route('front.check.single', ['product_id' => $product->id]) }}"
                             
                             class="mt-4 w-full bg-blue-800 text-white py-2 rounded-md hover:bg-blue-600 transition buy-now"
                             data-url="{{ route('front.cart.store') }}">
                         <i class="fas fa-shopping-cart"></i> &nbsp;  Order
                          </a>

          @endif

            <!-- <div class="flex items-center space-x-4 mt-2">
              <button class="px-3 py-1 bg-gray-200 text-gray-800 rounded-md">
                -
              </button>
              <span class="text-lg">0</span>
              <button class="px-3 py-1 bg-gray-200 text-gray-800 rounded-md">
                +
              </button>
            </div> -->
            <!-- <button
              class="mt-4 w-full bg-blue-800 text-white py-2 rounded-md hover:bg-blue-600 transition"
            >
              Add to Cart
            </button> -->
          </div>
        </a>
    </div>
       @empty
                                  <div align="center">
                                      <strong class="text-center text-danger">No products are available</strong>
                                  </div>
                                  @endforelse
        <!-- Product Card 4 -->
        
      </div>
    </section>
  </main>

  <div class="d-felx justify-content-center">

    {{ $products->links() }}

</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
    $('.buy-now').on('click', function (e) {
        e.preventDefault();

        var productId = $(this).attr('href').split('/').pop();
        var proQty = 1;
        var addToCartUrl = $(this).data('url');
        var checkoutUrl = "{{ route('front.cart.index') }}";
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Include CSRF token in AJAX request headers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Perform AJAX request to add the product to the cart
        $.post(addToCartUrl, { id: productId, quantity: proQty }, function (response) {
            // Redirect to checkout page after adding to cart
           window.location.href = "{{ route('front.checkout.index') }}";
        });
    });
});
</script>




@endpush

