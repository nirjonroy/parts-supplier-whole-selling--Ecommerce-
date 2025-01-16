@extends('frontend.app')
@section('title', 'Shop Product List')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<link rel="stylesheet" href="{{asset('frontend/assets/css/singleproduct.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<style>
   .slick-arrow {
   display: none !important;
   }
   p img{
   width: 100%
   }
   #myTabs li a {
   padding: 8px 9px;
   }
   #myTabs li {
   padding: 2px;
   }
</style>
<style>
   /* Styles for the slider container */
   .slider-container {
   width: 100%;
   overflow: hidden;
   position: relative;
   margin-left: 6%;

   }
   /* Styles for the big image */
   .slider-image {
    width: 88%;
    height: auto;
    display: block;
   }
   /* Styles for the mini image thumbnails */
   .thumbnail-container {
   /*display: flex;*/
   justify-content: center;
   /*margin-top : 3%;*/
   }
   .thumbnail {
   width: 50px;
   height: 50px;
   margin: 5px;
   cursor: pointer;
   }

   iframe{
       width: 100%;
   }

   @media only screen and (min-width: 320px) and (max-width: 375px) {
       iframe {
           width: 100% !important;
           height: 220px !important;
       }
   }

   @media only screen and (min-width: 376px) and (max-width: 425px) {
       iframe {
           width: 100% !important;
           height: 250px !important;
       }
   }

   @media only screen and (min-width: 426px) and (max-width: 500px) {
       iframe {
           width: 100% !important;
           height: 260px !important;
       }
   }

   .testslide-image {
       margin-left: 10px;
       margin-top: 10px;
   }

   .img-thumbnail:hover {
       box-shadow: 0px 0px 10px -4px green !important;
   }
   .img-thumbnail {
       box-shadow: 0px 0px 10px -4px gray !important;
   }
   .testslide-image img {
       box-shadow: 3px 4px 13px -3px gray !important;
   }
   .testslide-image img:hover {
       box-shadow: 0px 2px 13px -3px green !important;
   }

   .accordion-body .btn-info {
       background: #1F8C40 !important;
   }


</style>
@endpush
@section('content')
<section
        class="container mx-auto lg:my-8 p-4 lg:flex justify-center lg:space-x-8"
      >
        <!-- Product Image Section -->
        <div class="lg:w-1/4 mb-6 lg:mb-0">
         <div class="relative overflow-hidden rounded-lg shadow-lg">
            <!-- Main Image -->
            <img
              id="mainImage"
              src="{{ asset('uploads/custom-images/'.$product->thumb_image) }}"
              alt="Product Name"
              class="w-full h-auto object-contain"
            />
          </div>
          
          <!-- Additional Images or Thumbnails -->
          <div class="flex space-x-4 mt-4">
            <img
              src="{{ asset('uploads/custom-images/'.$product->thumb_image) }}"
              alt="Thumbnail"
              class="thumbnail w-24 h-24 object-cover rounded-md cursor-pointer hover:opacity-80"
              onclick="changeMainImage('{{ asset('uploads/custom-images/'.$product->thumb_image) }}')"
            />
          
            @foreach($product->gallery as $key => $img_gals)
              <img
                src="{{ asset($img_gals->image) }}"
                alt="Thumbnail {{ $key + 1 }}"
                class="thumbnail w-24 h-24 object-cover rounded-md cursor-pointer hover:opacity-80"
                onclick="changeMainImage('{{ asset($img_gals->image) }}')"
              />
            @endforeach
          </div>
          
          <script>
            // JavaScript function to change the main image
            function changeMainImage(newImageSrc) {
              document.getElementById("mainImage").src = newImageSrc;
            }
          </script>
          

        </div>

        <!-- Product Details Section -->
        <div class="lg:w-1/2">
          <h1 class="text-3xl font-bold text-gray-800 mb-4"> {{$product->name}}</h1>

          <!-- Star Rating -->
          <div class="flex items-center mb-4">
            <div class="flex text-yellow-400">
              <!-- Star Icon -->
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"
                />
              </svg>
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"
                />
              </svg>
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"
                />
              </svg>
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"
                />
              </svg>
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"
                />
              </svg>
            </div>
            <span class="text-gray-600 ml-2">(45 reviews)</span>
          </div>
          @if(!empty($product->offer_price))
          <p class="text-2xl font-semibold text-gray-900 mb-4">${{$product->offer_price}}</p>
          @if($product->offer_price > 0 && $product->price >0)
                        <del><span id="product-old-price" class="price old-price" style="font-size:14px;margin-left:10px">
                        </span>${{$product->price}}</del> $ ({{$product->price - $product->offer_price}} $ discount)
                        @endif
          @else
         
         <p class="text-2xl font-semibold text-gray-900 mb-4">${{$product->price}} </p>
         @endif

          @if($product->qty == '0')
                  <span style="color: red;font-weight: bold;">Out Of Stock</span>
                  @else
                  @endif
          <input type="hidden" name="product_id" value="{{ $product->id}}">
                  @if($product->offer_price != '0')
                  <input type="hidden" name="price" id="price_val" value="{{ $product->offer_price }}">
                  @else
                  <input type="hidden" name="price" id="price_val" value="{{ $product->price }}">
                  @endif
          <p class="text-gray-700 mb-6">
            {!! $product->feature !!}
          </p>
          @if($product->type == 'variable') <h6 id="select_size">Select Size : </h6> @else @endif
               @if($product->type == 'variable')

               @if(count($product->variations))

               <div class="sizes" id="sizes" style="margin-bottom: 5px;">
                  @foreach($product->variations as $v)
                  @if(!empty($v->size->title))
                  <div class="size" data-proid="{{ $v->product_id }}" data-varprice="{{ $v->sell_price }}" data-varsize="{{ $v->size->title }}"
                     value="{{$v->id}}">
                     @if($v->size->title == 'free')
                     @else
                     {{ $v->size->title }}
                     <input type="hidden" id="size_value" name="variation_id">
                     <input type="hidden" id="size_variation_id" name="size_variation_id">
                     <input type="hidden" name="pro_price" id="pro_price">
                     @endif
                  </div>
                  @else
                  Size Not Available
                  @endif
                  @endforeach
               </div>
               @else
               <input type="text" id="size_value" name="variation_id" value="free">
               @endif

               @endif

              @if($product->prod_color == 'varcolor') <h6 id="select_color">Select Color : </h6> @else @endif
               @if($product->prod_color == 'varcolor')
               <div class="colors" id="colors">
                  @foreach($product->colorVariations as $v)
                  @if(!empty($v->color->code))
                  <div class="color" style="background: {{$v->color->code}}" data-proid="{{ $v->product_id }}" data-colorid="{{ $v->color_id }}" data-varcolor="{{ $v->color->name}}"
                     value="{{$v->id}}">
                     <input type="hidden" id="color_val" name="color_id" >
                     <!--<img src="{{ asset($v->var_images) }}" width="50px" height="50px" /> -->
                     <input type="hidden" id="color_value" name="variationColor_id">
                  </div>
                  @else
                  Color Not Available
                  @endif
                  @endforeach
               </div>
                @else
                <input type="hidden" id="color_value" name="variationColor_id" value="default">
               @endif
          <!-- Quantity and Add to Cart Button -->
          <div class="flex items-center space-x-4 mb-6">
            <div class="flex border border-gray-300 rounded-md">
              <button class="px-4 py-2 text-gray-600 decrease-qty">-</button>
              <input
                type="number"
               
                id="quantity" min="1" value="1"
                class="w-12 text-center border-0 qty"
              />
              <button class="px-4 py-2 text-gray-600 increase-qty">+</button>
            </div>
            @if($product->qty == '0')
            <button
            data-id="{{ $product->id }}"
            data-url="{{ route('front.cart.store') }}"
              class="bg-red-600 text-white px-8 py-2 rounded-md font-semibold hover:bg-blue-600 transition add_cart add-to-cart"
            >
              Add to Cart
            </button>
            @else
            <button
            data-id="{{ $product->id }}"
            data-url="{{ route('front.cart.store') }}"
              class="bg-red-600 text-white px-8 py-2 rounded-md font-semibold hover:bg-blue-600 transition add_cart add-to-cart"
            >
              Add to Cart
            </button>
            @endif
          </div>

          <!-- Favorite Button -->
          

          <!-- Product Details -->
          <div class="mt-8">
            <h2 class="text-lg font-semibold mb-4">Product Details</h2>
            <ul class="list-disc pl-5 text-gray-700">
              <p>{!!$product->long_description!!}</p>
            </ul>
          </div>
        </div>
      </section>

     
@endsection
@push('js')

<script>
   $(document).ready(function () {
       $('.buy-now').on('click', function (e) {
           e.preventDefault();

           let variation_id = $('#size_variation_id').val();
           let variation_size = $('#size_value').val();
           let variation_color = $('#color_value').val();
           let variation_price = $('#pro_price').val();
           var productId = $(this).attr('href').split('/').pop();
           var proQty = $('#quantity').val();
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
           $.post(addToCartUrl,
           {
               id              : productId,
               quantity        : proQty,
               variation_id    : variation_id,
               varSize         : variation_size,
               varColor        : variation_color,
               variation_price : variation_price
           },

           function (response) {

               if(response.status)
               {
                   toastr.success(response.msg);
                   // Redirect to checkout page after adding to cart
                   window.location.href = "{{ route('front.checkout.index') }}";
               } else {
            // Check if the response contains validation errors
            if (response.errors) {
                for (var field in response.errors) {
                    if (response.errors.hasOwnProperty(field)) {
                        for (var i = 0; i < response.errors[field].length; i++) {
                            toastr.error(response.errors[field][i]);
                        }
                    }
                }
            } else {
                toastr.error(response.msg || 'An error occurred while processing your request.');
            }
        }

           });
       });
   });

</script>
<script>
   $(document).ready(function () {
       $('.increase-qty').on('click', function () {
           var qtyInput = $(this).siblings('.qty');
           var newQuantity = parseInt(qtyInput.val()) + 1;
           qtyInput.val(newQuantity);
       });

       $('.decrease-qty').on('click', function () {
           var qtyInput = $(this).siblings('.qty');
           var newQuantity = parseInt(qtyInput.val()) - 1;
           if (newQuantity > 0) {
               qtyInput.val(newQuantity);
           }
         else{

         }
       });
   });


</script>
<script>
   $(function () {

      $(document).on('click', '.add-to-cart', function (e) {

          let variation_id = $('#size_variation_id').val();
          let variation_size = $('#size_value').val();
          let variation_color = $('#color_value').val();
          let variation_price = $('#pro_price').val();
          let quantity = $('#quantity').val();
          let id = $(this).data('id');
          let url = $(this).data('url');

          addToCart(url, id,variation_size, variation_color, variation_id,variation_price,quantity);
      });

      // ... other click event handlers ...

      function addToCart(url, id, varSize ="", varColor = "", variation_id="",variation_price="",quantity,type = "") {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $.ajax({
              type: "POST",
              url: url,
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              data: { id,varSize,varColor,variation_id, variation_price,quantity },
             success: function (res) {

                  if (res.status) {
                      toastr.success(res.msg);
            if (type) {
                if (res.url !== '') {
                    document.location.href = res.url;
                } else {
                    // Handle specific case
                }
            } else {
                window.location.reload();
            }
        } else {
            // Check if the response contains validation errors
            if (res.errors) {
                for (var field in res.errors) {
                    if (res.errors.hasOwnProperty(field)) {
                        for (var i = 0; i < res.errors[field].length; i++) {
                            toastr.error(res.errors[field][i]);
                        }
                    }
                }
            } else {
                toastr.error(res.msg || 'An error occurred while processing your request.');
            }
        }

              },
              error: function (xhr, status, error) {
                  toastr.error('An error occurred while processing your request.');
              }
          });
      }

      // ... other functions ...


   });
   $(document).ready(function() {
              $('.popup-link').magnificPopup({
                  type: 'image', // Set the content type to 'image'
                  gallery: {
                      enabled: true // Enable gallery mode
                  }
              });
          });

   $('#sizes .size').on('click', function(){
      $('#sizes .size').removeClass('active');
      $(this).addClass('active');
      let value = $(this).attr('value');
      let varSize = $(this).data('varsize');

      $('#select_size').text('Select Size : '+varSize);


      // Assuming you have retrieved the selected variation price somehow
      let variationPrice = parseFloat($(this).data('varprice'));

      $.ajax({
          type: 'get',
          url: '{{ route("front.product.get-variation_price") }}',
          data: {
              varSize,
            	value,
              variationPrice, // Pass variation price to the server
          },
          success: function(res) {
              $('.current-price-product').text('' + res.price);
            	$('#size_value').val();
              $('#price_val').val(res.price);
              $('#pro_price').val(res.price);
              console.log(res);
          }
      });

      $("#size_value").val(varSize);
      $("#size_variation_id").val(value);
   });


   let imageClick = false;

   $('#colors .color').on('click', function(){
      $('#colors .color').removeClass('active');
      $(this).addClass('active');
      let value = $(this).attr('value');
      let varColor = $(this).data('varcolor');
      let product_id = $(this).data('proid');
      let color_id = $(this).data('colorid');

      $('#select_color').text('Select Color : '+varColor);

      // Assuming you have retrieved the selected variation price somehow
      let variationColor = parseFloat($(this).data('varcolor'));

      $.ajax({
          type: 'get',
          url: '{{ route("front.product.get-variation_color") }}',
          data: {
              varColor,
            	value,
              variationColor,
            	product_id,
              color_id
            // Pass variation price to the server
          },
          success: function(res) {
              //$('.current-price-product').text('' + res.price);
            	$('.testslide-image').html(res.var_images);

            	$('#color_value').val();
              //$('#price_val1').val(res.price);
              console.log(res);

              imageClick = true;
          }
      });

      $("#color_value").val(varColor);
      $("#color_value1").val(value);
   });

   $(document).on('click', '.slider-container', function() {
      if (imageClick) {

      }
   });


   // JavaScript function to change the big image
    function changeImage(imageUrl) {

        document.getElementById('big-image').src = imageUrl;
    }


    function changeImage(newImageSrc) {
        // Get the "big-image" element by its ID
        var bigImage = document.getElementById("big-image");

        // Update the source of the big image with the new image source
        bigImage.src = newImageSrc;
    }



</script>
@endpush
