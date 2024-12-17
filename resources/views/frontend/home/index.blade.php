@extends('frontend.app')
@section('title', 'Home')
@push('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')


<main>

    <section class="container mx-auto h-full bg-no-repeat bg-cover bg-center">
        <div class="relative overflow-hidden">
            @if (!empty($slider) && $slider->count())
            <div
                id="slider"
                class="flex transition-transform duration-500 ease-in-out"
                style="width: 100%"
            >
                @foreach ($slider as $index => $slide)
                <div class="w-full flex-shrink-0">
                    <img
                        src="{{ asset($slide->image) }}"
                        alt="Slide {{ $index + 1 }}"
                        class="w-full lg:h-[400px] h-[200px] object-cover lg:rounded-[50px]"
                    />
                </div>
                @endforeach
            </div>
        
            <!-- Slider Dots -->
            <div
                id="slider-dots"
                class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2"
            >
                @foreach ($slider as $index => $slide)
                <button class="dot w-2 h-2 {{ $index === 0 ? 'bg-gray-800' : 'bg-gray-400' }} rounded-full"></button>
                @endforeach
            </div>
            @else
            <strong class="text-center text-red-500">No slides available</strong>
            @endif
        </div>

        <!-- Promotional Banners Section -->
        @php 
         $promotion = DB::table('about_us')->get();
        @endphp
        <div
          class="flex max-w-7xl mx-auto gap-x-2 lg:gap-x-4 justify-around mt-3 lg:mt-6"
        >
        @foreach ($promotion as $item)
        <div class="flex-1 m-2">
            <img
              src="{{$item->video_background}}"
              alt="Promo Banner 1"
              class="w-full h-[115px] lg:h-[300px] object-cover rounded-md lg:rounded-[50px]"
            />
          </div>
        @endforeach
         

          
        </div>
        
    </section>

    <section class="my-8 lg:my-20 container mx-auto">
        <h2
          class="text-2xl lg:text-4xl font-extrabold text-gray-800 mb-8 text-center relative"
        >
          <span class="block">Featured Products</span>
          <span
            class="absolute inset-x-0 -bottom-4 h-1 bg-blue-500 rounded-md transform scale-x-50 transition-transform duration-300 origin-center"
          ></span>
        </h2>

        <div class="owl-carousel owl-theme">
            <!-- Loop through each product and create a separate item for each one -->
            @foreach ($feature_products as $product)
            <div class="item p-4">
              <a href="{{ route('front.product.show', [ $product->id ] ) }}" class="block">
                <div
                  class="border rounded-lg shadow-lg py-2 overflow-hidden transition-transform duration-300 transform hover:scale-105"
                >
                  <img
                    src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-[150px] object-contain"
                  />
                  <div class="p-4 flex flex-col justify-center items-center">
                    <h3 class="text-base mb-2 lg:text-lg text-gray-800">
                        {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                    </h3>
                    <p class="text-gray-600 text-base font-bold">
                      @if(empty($product->offer_price))
                        $ {{$product->price}}
                      @else
                        $ {{$product->offer_price}} 
                        <del class="text-gray-600 ml-2" style="font-size: 13px !important">$ {{$product->price}} </del>
                      @endif
                    </p>
          
                    <!-- Star Rating -->
                    <div class="flex items-center mt-2">
                      <span class="text-yellow-500"> ★★★★☆ </span>
                    </div>
          
                    <div class="flex justify-between items-center mt-4">
                      <button
                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors"
                      >
                        Add to Cart
                      </button>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          </div>
          
      </section>


      <section class="my-8 lg:my-20 container mx-auto">
        <h2 class="text-2xl lg:text-4xl font-extrabold text-gray-800 mb-8 text-center relative">
            <span class="block">Best Seller Products</span>
            <span class="absolute inset-x-0 -bottom-4 h-1 bg-blue-500 rounded-md transform scale-x-50 transition-transform duration-300 origin-center"></span>
        </h2>
    
        <div class="owl-carousel owl-theme">
            @foreach ($feature_products as $product)
            <div class="item p-4">
                <a href="{{ route('front.product.show', [ $product->id ] ) }}" class="block">
                    <div class="border rounded-lg shadow-lg py-2 overflow-hidden transition-transform duration-300 transform hover:scale-105">
                        <img src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}" alt="{{ $product->name }}" class="w-full h-[150px] object-contain" />
                        <div class="p-4 flex flex-col justify-center items-center">
                            <h3 class="text-base mb-2 lg:text-lg text-gray-800">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</h3>
                            @if(empty($product->offer_price))
                                <p class="text-gray-600 text-base font-bold">$ {{ $product->price }}</p>
                            @else
                                <p class="text-gray-600 text-base font-bold">$ {{ $product->offer_price }}</p>
                                <del class="text-gray-600" style="font-size: 13px !important">$ {{ $product->price }}</del>
                            @endif
                            <!-- Star Rating -->
                            <div class="flex items-center mt-2">
                                <span class="text-yellow-500">★★★★☆</span>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    



    <section class="my-8 lg:my-20 container mx-auto">
        @if(!empty($popularProducts))
            @foreach ($popularProducts as $categoryId => $products)
                <!-- Category Section -->
                <div class="bg-red-600 rounded-md container-fluid">
                    <div class="col-12 product-header text-center">
                        <div class="section_title text-white">
                            @if(!empty($products->first()->category->slug))
                                <a href="{{ url('shop', $products->first()->category->slug) }}" class="text-white p-4 d-block">
                                    <h2 class="semi font-extrabold text-2xl lg:text-4xl">{{ $products->first()->category->name }}</h2>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
    
                <!-- Product Carousel -->
                <div class="container-fluid p-0 mt-4">
                    <div class="owl-carousel owl-theme slider_product">
                        @foreach ($products as $product)
                            <div class="item p-4">
                                <div class="border rounded-lg shadow-lg py-2 overflow-hidden transition-transform duration-300 transform hover:scale-105">
                                    <!-- Product Image -->
                                    <a href="{{ route('front.product.show', [ $product->id ]) }}" class="block w-full h-[150px] bg-white">
                                        <img src="{{ asset('uploads/custom-images2/' . $product->thumb_image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                    </a>
    
                                    <!-- Product Details -->
                                    <div class="p-4 text-center">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</h3>
                                        
                                        <!-- Pricing -->
                                        <p class="text-gray-600 font-bold">
                                            @if($product->offer_price > 0)
                                                <span class="text-red-500">${{ $product->offer_price }}</span>
                                                <del class="text-gray-500 ml-2">${{ $product->price }}</del>
                                            @else
                                                <span class="text-gray-700">${{ $product->price }}</span>
                                            @endif
                                        </p>
    
                                        <!-- Rating (Assuming you have a rating field) -->
                                        <div class="flex items-center justify-center mt-2">
                                            <span class="text-yellow-500">★★★★☆</span>
                                            <span class="text-gray-600 ml-2">(4.0)</span>
                                        </div>
    
                                        <!-- Add to Cart / Order Button -->
                                        <div class="mt-4">
                                            @if($product->type == 'variable')
                                                <a href="{{ route('front.product.show', [ $product->id ]) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                                    <i class="fas fa-shopping-cart"></i> Order Now
                                                </a>
                                            @else
                                                <a href="{{ route('front.check.single', ['product_id' => $product->id]) }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-600">No products available at the moment.</p>
        @endif
    </section>
    


    










    <!--<section class="news-later py-4 my-2 ">-->
    <!--    <div class="container bg-light border-rounded p-4">-->
    <!--        <h4 class="display-6 text-center text-uppercase fw-bold"><span class="text-danger">Subscribe Our</span>-->
    <!--            Newslater</h4>-->
    <!--        <div class="d-flex flex-column align-items-center jsutify-content-center">-->

    <!--            <input type="email" width="100%" placeholder="Enter your Email" class="px-4 py-2 rounded">-->
    <!--        </div>-->


    <!--    </div>-->
    <!--</section>-->

    <!-- reviews -->

    <!--<section class="container">-->
    <!--    <div class="row d-flex justify-content-center">-->
    <!--        <div class="col-md-10 col-xl-8 text-center">-->
    <!--            <h3 class="mb-4">Testimonials</h3>-->
    <!--            <p class="mb-4 pb-2 mb-md-5 pb-md-0">-->
    <!--                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet-->
    <!--                numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum-->
    <!--                quisquam eum porro a pariatur veniam.-->
    <!--            </p>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--    <div class="row text-center">-->
    <!--        <div class="col-md-4 mb-5 mb-md-0">-->
    <!--            <div class="d-flex justify-content-center mb-4">-->
    <!--                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp"-->
    <!--                    class="rounded-circle shadow-1-strong" width="150" height="150" />-->
    <!--            </div>-->
    <!--            <h5 class="mb-3">Maria Smantha</h5>-->

    <!--            <p class="px-xl-3">-->
    <!--                <i class="fas fa-quote-left pe-2"></i>Lorem ipsum dolor sit amet, consectetur-->
    <!--                adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic-->
    <!--                tenetur.-->
    <!--            </p>-->
    <!--            <ul class="list-unstyled d-flex justify-content-center mb-0">-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star-half-alt fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!--        <div class="col-md-4 mb-5 mb-md-0">-->
    <!--            <div class="d-flex justify-content-center mb-4">-->
    <!--                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(2).webp"-->
    <!--                    class="rounded-circle shadow-1-strong" width="150" height="150" />-->
    <!--            </div>-->
    <!--            <h5 class="mb-3">Lisa Cudrow</h5>-->

    <!--            <p class="px-xl-3">-->
    <!--                <i class="fas fa-quote-left pe-2"></i>Ut enim ad minima veniam, quis nostrum-->
    <!--                exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid commodi.-->
    <!--            </p>-->
    <!--            <ul class="list-unstyled d-flex justify-content-center mb-0">-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!--        <div class="col-md-4 mb-0">-->
    <!--            <div class="d-flex justify-content-center mb-4">-->
    <!--                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(9).webp"-->
    <!--                    class="rounded-circle shadow-1-strong" width="150" height="150" />-->
    <!--            </div>-->
    <!--            <h5 class="mb-3">John Smith</h5>-->

    <!--            <p class="px-xl-3">-->
    <!--                <i class="fas fa-quote-left pe-2"></i>At vero eos et accusamus et iusto odio-->
    <!--                dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.-->
    <!--            </p>-->
    <!--            <ul class="list-unstyled d-flex justify-content-center mb-0">-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="fas fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <i class="far fa-star fa-sm text-warning"></i>-->
    <!--                </li>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
</main>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    });
</script>

<script>
$(document).ready(function () {
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
 $(function () {
   // Add CSS to initially hide the .offerBox
        function setCookie(name, value, minutes) {
            var expires = "";
            if (minutes) {
                var date = new Date();
                date.setTime(date.getTime() + (minutes * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1, c.length);
                }
                if (c.indexOf(nameEQ) == 0) {
                    return c.substring(nameEQ.length, c.length);
                }
            }
            return null;
        }

        $(".modal-overlay").click(function(){
            $('.offerBox').hide();
            setCookie('offerBoxHidden', 'true', 5);
        })

        $(".offerBox .content .close").click(function(){
            $('.offerBox').hide();
            setCookie('offerBoxHidden', 'true', 5);
        })

        // Check if the offerBox should be hidden based on the cookie
        var offerBoxHidden = getCookie('offerBoxHidden');

        if (offerBoxHidden === 'true') {
            $('.offerBox').hide();
        }





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

    // ... other functions ...

});

</script>

<script>
    $(document).ready(function() {
    $('.select2').select2({
    closeOnSelect: true
});
});
</script>

<!-- Place this JavaScript code after your HTML content -->
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
            toastr.success(response.msg);
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

    $(document).ready(function(){
    $('.owl-carousel').show();
    $('.product_slider_sell').owlCarousel({
      items: 1, // Set the number of items to show
      loop: true, // Enable infinite loop

      autoplay: true, // Enable autoplay
      autoplayTimeout: 3000, // Set autoplay timeout in milliseconds
      autoplayHoverPause: true, // Pause autoplay on hover
      rewind: false,
        responsive:{
            0:{
                items:1,

            },
            380: {
                items: 2,

            },
            500: {
                items: 2,

            },
            600:{
                items:3
            },
            870: {
                items: 4
            },
            1070:{
                items:5
            },
            1200: {
                items: 5
            },
            1300: {
                items: 5
            },
            1400: {
                items: 6
            }
        }
    });

    $('.slider_product').owlCarousel({
      items: 1, // Set the number of items to show
      loop: true, // Enable infinite loop

      autoplay: true, // Enable autoplay
      autoplayTimeout: 3000, // Set autoplay timeout in milliseconds
      autoplayHoverPause: true, // Pause autoplay on hover
      rewind: false,
        responsive:{
            0:{
                items:1,

            },
            380: {
                items: 2,

            },
            500: {
                items: 2,

            },
            600:{
                items:3
            },
            870: {
                items: 4
            },
            1070:{
                items:5
            },
            1200: {
                items: 5
            },
            1300: {
                items: 5
            },
            1400: {
                items: 6
            }
        }
    });
});

    document.addEventListener("DOMContentLoaded", function () {
        var popUpForm = document.getElementById("popUpForm");

        var shouldShowPopup = localStorage.getItem("showPopup");
        var lastCloseTime = localStorage.getItem("lastCloseTime");

        if (!shouldShowPopup || (shouldShowPopup && lastCloseTime && Date.now() - lastCloseTime >= 5 * 60 * 1000)) {
            popUpForm.style.display = "block";
        }
        // setTimeout(function () {
        //         popUpForm.style.display = "none";
        //     }, 10000);
        document.querySelector('.popupGrid').addEventListener('click', function(event) {
            if (event.target.classList.contains('popupGrid')) {
                popUpForm.style.display = "none";
                localStorage.setItem("showPopup", false);
                localStorage.setItem("lastCloseTime", Date.now());
            }
        });
        document.getElementById("close").addEventListener("click", function () {
            popUpForm.style.display = "none";
            localStorage.setItem("showPopup", false);
            localStorage.setItem("lastCloseTime", Date.now());
        });
    });

</script>





@endpush
