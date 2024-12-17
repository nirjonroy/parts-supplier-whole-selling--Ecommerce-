@extends('frontend.app')
@section('title', 'Shop Product List')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/silck/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}

  <style>
         
           @media (min-width: 1024px){
             .prodCatcus{
               	  background: rgb(255 153 0);
                  border-radius: 0px;
                  border-top-right-radius: 70px;
                  width: 16%;
                  padding: 0px;
                  margin: 0px;
             	}
               .carousel-item img{
                   height: 535px;
               }
               /*.product-item {*/
               /*    width: 205px !important;*/
               /*}*/
               .select2-container--default .select2-selection--single {
                   height: 40px;
               }
               .select2-container--default .select2-selection--single .select2-selection__rendered {
                   line-height: 40px;
                   font-size: 13px;
               }
               .select2-container--default .select2-selection--single .select2-selection__arrow {
                   top: 7px;
               }
               .select2-container{
                   width: 100% !important;
               }
             
             .prd_img{
             	margin-bottom: -20px !important;
             }
           }
           
           @media only screen and (min-width: 250px) and (max-width: 319px) {
             .prodCatcus{
               	  background: rgb(255 153 0);
                  border-radius: 0px;
                  border-top-right-radius: 70px;
                  width: 24%;
                  padding: 0px;
                  margin: 0px;
             	}
               .col-lg-3 {
                   width: 100% !important;
                    margin-left: 0% !important;
               }
               .col-lg-9 {
                   padding-right: 0px !important;
               }
               .select2-container {
                   width: 70% !important;
               }
               
               .left_side_img img{
                  height: auto !important; 
               }
             
             .left_side_img{
             		display:none
             	}
             
             .prd_img{
             	margin-bottom: -20px !important;
             }
             
             .sidebar-filter{
              	display: none;
              }
               
            }
            
            @media only screen and (min-width: 367px) and (max-width: 385px) {
                .semi {
                    font-size: 13px !important;
                }
            }
           
           @media only screen and (min-width: 320px) and (max-width: 375px) {
             .prodCatcus{
               	  background: rgb(255 153 0);
                  border-radius: 0px;
                  border-top-right-radius: 70px;
                  width: 56%;
                  padding: 0px;
                  margin: 0px;
             	}
               .col-lg-3 {
                   width: 100% !important;
                    margin-left: 0% !important;
               }
               .col-lg-9 {
                   padding-right: 0px !important;
               }
               .select2-container {
                   width: 70% !important;
               }
               .left_side_img img{
                  height: auto !important; 
               }
             .primcusImg{
             	margin-left: 0% !important;
             }
             
             .seccusImg{
             	margin-left: 15% !important;
             }
             .bg-orange{
             		width: 40% !important;
               		height: 33px !important;
               		font-size: 14px !important;
             	}
             .slick-next .slick-arrow {
             	margin-top : -14px !important;
             	}
             
             header img {
                  height: 70px;
                  width: 220px;
                  padding-left: 0;
              }
             
             .left_side_img{
             		display:none
             	}
             
             .sidebar-filter{
              	display: none;
              }
             
            }
            @media only screen and (min-width: 376px) and (max-width: 575px) {
              .prodCatcus{
               	  background: rgb(255 153 0);
                  border-radius: 0px;
                  border-top-right-radius: 70px;
                  width: 56%;
                  padding: 0px;
                  margin: 0px;
             	}
                .col-lg-3 {
                   width: 100% !important;
                    margin-left: 0% !important;
               }
               .col-lg-9 {
                   padding-right: 0px !important;
               }
               .select2-container {
                   width: 70% !important;
               }
               .left_side_img img{
                  height: auto !important; 
               }
              
              .prd_prc_bx{
              	margin-top: 10%;
              }
              
              .left_side_img{
             		display:none
             	}
              
              .prd_img{
             	margin-bottom: -20px !important;
             }
              
              .primcusImg{
              		margin-left: 0%;
              }
              
              .sidebar-filter{
              	display: none;
              }
              
            }
         
         	 @media only screen and (min-width: 376px) and (max-width: 379px) {
            
               .primcusImg{
               			margin-left: 0%;
               }
               
               .sidebar-filter{
              	display: none;
              }
         	}
         
         @media only screen and (min-width: 768px) and (max-width: 900px) {
            
               .primcusImg{
               			margin-left: 0%;
               }
           
           		.sidebar-filter{
              	display: none;
              }
         	}
         
         
            
             @media only screen and (min-width: 576px) and (max-width: 991px) {
               .prodCatcus{
               	  background: rgb(255 153 0);
                  border-radius: 0px;
                  border-top-right-radius: 70px;
                  width: 24%;
                  padding: 0px;
                  margin: 0px;
             	}
               
                 .col-lg-3 {
                   width: 100% !important;
                    margin-left: 0% !important;
               }
               .col-lg-9 {
                   padding-right: 0px !important;
               }
               .select2-container {
                   width: 60% !important;
               }
               .left_side_img img{
                  height: auto !important; 
               }
               
               .prd_img{
             	margin-bottom: -20px !important;
             }
               
             }
            
            @media only screen and (min-width: 992px) and (max-width: 1348px) {
              .prodCatcus{
               	  background: rgb(255 153 0);
                  border-radius: 0px;
                  border-top-right-radius: 70px;
                  width: 24%;
                  padding: 0px;
                  margin: 0px;
             	}
              
                .col-lg-3 {
                   width: 24% !important;
                   margin-left: 1% !important;
               }
               .col-lg-9 {
                   width: 75% !important;
                   padding-right: 0px !important;
               }
            }
            @media only screen and (min-width: 1401px) and (max-width: 1500px) {
                
            }
    
    		@media only screen and (min-width: 376px) and (max-width: 575px) {
              .primcusImg{
              	margin-left: 0% ;	
              }
              .sidebar-filter{
              	display: none;
              }
    		}
            
            @media only screen and (min-width: 378px) and (max-width: 412px) {
                    .bg-orange{
                        font-size: 8px !important;
                    }     
              
                    .prd_prc_bx{
          				padding-bottom: 6px !important;
            			margin-top:10% !important;
              		}
            }
            
            .product-item {
                transition: box-shadow 0.5s !important;
            }
            
            .product-item:hover {
                box-shadow: 0px 2px 13px -3px gray !important;
            }
            
            @media only screen and (min-width: 320px) and (max-width: 375px) {
                .product-box .product-item .product_content {
                    margin-top: 0px !important;
                }
            }
            
            @media only screen and (min-width: 376px) and (max-width: 576px) {
                .product-box .product-item .product_content {
                    margin-top: 5% !important;
                }
            }
            
            @media only screen and (min-width: 1084px) and (max-width: 1141px) {
                .product_content a {
                    font-size: 14px !important;
                }
            }
            
             @media only screen and (min-width: 992px) and (max-width: 1083px) {
                .product_content a {
                    font-size: 12px !important;
                }
            }
            
            @media only screen and (min-width: 768px) and (max-width: 856px) {
                .product_content a {
                    font-size: 13px !important;
                }
            }
            
            @media only screen and (min-width: 576px) and (max-width: 643px) {
                .product_content a {
                    font-size: 13px !important;
                }
            }
            
            
            @media only screen and (min-width: 576px) and (max-width: 991px) {
                .sidebar-filter {
                    display: none !important;
                }
            }
            
            @media only screen and (min-width: 367px) and  (max-width: 575px) {
                .col-md-3 {
                    width: 50% !important;
                }
            }
           
       </style>


@endpush
@section('content')
<div class="categoryHeader">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page" style="background:lightblue;">
                
            </li>
        </ol>
    </nav>
</div>

<style>
    .form-check-label {
        color: black !important;
        font-weight: bold;
    }
</style>
<div class="container-fluid">
<div class="main-wrapper">
    <div class="overlay-sidebar"></div>
    <div class="category-page col-lg-12 col-12 p-0 m-auto mt-2 mb-2">
        <div class="row">
            <!-- filter section  -->
            <section class="sidebar-filter col-lg-3">
                <div class="bg-white p-3">
                    <div class="accordion-box">
                        <div class="accordion-title">
                            <span class="circle" style="color: #10c92f;">
                                <i class="fas fas fa-minus"></i>
                            </span>
                            <span>
                                Price
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="range-slider">
                                <form id="price-range-form">
                                    <input id="min-price" name="min_price" value="{{ $minPrice }}" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="2" type="range">
                                    <input id="max-price" name="max_price" value="{{ $maxPrice }}" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="2" type="range">
                                    <span>
                                        <div>
                                            <span class="">৳</span><input id="min-price-input" type="number" value="0" min="">
                                            <span class="">৳</span><input id="max-price-input" type="number" value="" >
                                        </div>
                                    </span>
                                    <br/> 
                                    <button type="submit" class="btn btn-warning btn-sm">Apply</button>
                                </form>
                            </div>


                        </div>
                    </div>
                    <br><br>
                   <div class="accordion-box">
                        <div class="accordion-title">
                            <span class="circle">
                                <i class="fas fas fa-minus"></i>
                            </span>
                            <span>
                                Avaiablity 
                            </span>
                        </div>
                        <div class="accordion-body">
                            <form id="availability-filter-form">
                                <div class="form-check py-2">
                                    <input class="form-check-input shadow-none" type="checkbox" value="1" name="in_stock" id="check-1">
                                    <label class="form-check-label" for="check-1">
                                        In Stock
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input shadow-none" type="checkbox" value="1" name="out_of_stock" id="check-2">
                                    <label class="form-check-label" for="check-2">
                                        Out of Stock
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-info">Apply</button>
                                <button type="button" id="clear-filter" class="btn btn-danger">Clear</button>
                            </form>
                        </div>
                    </div>



                    <!--<div class="accordion-box">-->
                    <!--    <div class="accordion-title">-->
                    <!--        <span class="circle">-->
                    <!--            <i class="fas fas fa-minus"></i>-->
                    <!--        </span>-->
                    <!--        <span>-->
                    <!--            Brands-->
                    <!--        </span>-->
                    <!--    </div>-->
                    <!--    <div class="accordion-body">-->
                    <!--        <div class="brands pt-2">-->
                    <!--              <div class="form-check py-2 brand">-->
                    <!--                <input class="form-check-input shadow-none" type="checkbox" value="" id="brand-1">-->
                    <!--                <label class="form-check-label" for="brand-1">-->
                    <!--                    <img src="{{asset('frontend/assets/image/money.png')}}" alt="">-->
                    <!--                  Out of Stock-->
                    <!--                </label>-->
                    <!--              </div>-->
                    <!--              <div class="form-check py-2 brand">-->
                    <!--                <input class="form-check-input shadow-none" type="checkbox" value="" id="brand-2">-->
                    <!--                <label class="form-check-label" for="brand-2">-->
                    <!--                    <img src="{{asset('frontend/assets/image/money.png')}}" alt="">-->
                    <!--                  Out of Stock-->
                    <!--                </label>-->
                    <!--              </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </section>
        <!-- filter section  -->
        <!-- Products -->
            <section class="products-box col-lg-9 col-md-12">
                <div class="bg-white p-3 pt-1">
                    <div class="product-bar">
                        <div class="btn-list">
                            @if(!empty($products[0]->category))
                    {{ $products[0]->category->name }}
                @endif
                @if(!empty($products[0]->subCategory))
                > {{ $products[0]->subCategory->name }}
                @endif
                @if(!empty($products[0]->childCategory))
                > {{ $products[0]->childCategory->name }}
                @endif
                            <!--<button class="filter-btn btn d-block d-md-block d-lg-none">-->
                            <!--   <i class="fas fa-filter"></i> Filter-->
                            <!--</button>-->
                            <!--<button class="compare-btn btn d-none d-md-none d-lg-block">-->
                            <!--   <i class="fas fa-repeat"></i> Product Compare-->
                            <!--</button>-->
                        </div>
                        <div class="filter-sort d-flex align-items-center">
                            <div class="d-flex align-items-center me-2">
                              <!--<label for="" class="form-label me-2 mb-0" style="white-space: nowrap;">Sort By: </label>-->
                              <!--<select name="" id="" class="form-select shadow-none">-->
                              <!--  <option value="">Select One</option>-->
                              <!--  <option value="">High to Low</option>-->
                              <!--</select>-->
                            </div>
                            <div class="d-lg-flex d-md-none d-none align-items-center">
                              <!--<label for="" class="form-label me-2 mb-0">Show:</label>-->
                              <!--<select name="" id="" class="form-select shadow-none">-->
                              <!--  <option value="">10</option>-->
                              <!--  <option value="">20</option>-->
                              <!--</select>-->
                            </div>
                        </div>
                    </div>
                    <div class="product-box py-1 bg-muted row">
                        @forelse($flashSell  as $key => $product)

<div class="col-md-3 col-sm-4">
                       
                            <div class="product-item">
                                <div class="product_thumb bg-white prd_img" style="">
                    <a class="primary_img " href="{{ route('front.product.show', [ $product->product->id ] ) }}"><img src="{{ asset('uploads/custom-images2/'.$product->product->thumb_image) }}" class="primcusImg" alt=""></a>
                    <a class="secondary_img " href="{{ route('front.product.show', [ $product->product->id ] ) }}"><img src="{{ asset('uploads/custom-images2/'.$product->product->thumb_image) }}" style="margin-left:5%" class="seccusImg" alt=""></a>
                    
                                  @if($product->product->offer_price > 0)
                                        <div class="label_product" style="width: 102px;">
                                            <span class="label_sale" style="padding-top: 2px;">{{ BanglaText('offer') }}</span>
                                        </div>
                                        @endif
                                      @if($product->product->is_free_shipping > 0)
                                        <div class="label_product" style="width: 102px; background:#3276B1; left: 0%; border-radius: 5px 30px 30px 5px">
                                            <span class="label_sale" style="padding-top: 2px;">{{ BanglaText('free') }}</span>
                                        </div>
                                        @endif
                                    <!--<div class="action_links">-->
                                    <!--    <ul>-->
                                    <!--        <li class="wishlist"><a href="#" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></a></li>-->
                                    <!--        <li class="compare"><a href="#" title="compare"><i class="fa-solid fa-repeat"></i></a></li>-->
                                    <!--        <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="fa-regular fa-eye"></i></a></li>-->
                                    <!--    </ul>-->
                                    <!--</div>-->
                                </div>
                                <div class="product_content " style="border-top:3px solid #EDEDEF; margin-top: 10%; ">
                                    <h4 class="ps-1" style="height: 40px;">
                                         
                                        <a href="{{ route('front.product.show', [ $product->product->id ] ) }}" class="font-16" style="font-size:14px">{{ \Illuminate\Support\Str::limit($product->product->name, 50)}}</a>
                                    </h4>
                                   
                                    <div class="price_box ps-1" style="padding-bottom: 0px; margin-top:13%;">
                                        @if(empty($product->product->offer_price))
                                        <span class="current_price">{{ $product->product->price }} Tk</span>

                                        @else
                                        <span class="current_price">{{ $product->product->offer_price }} Tk</span>
                                        <span class="old_price">{{ $product->product->price }} Tk</span>

                                        @endif

                                    </div>
                                    <div class="rounded-0 bg-muted p-2 d-flex justify-content-between">

                       <!--                 <a data-id="{{ $product->product->id }}" data-url="{{ route('front.cart.store') }}" style="color: white;font-size: 13px;background: red;border: solid;" class="btn btn-sm btn-warning semi add-to-cart">-->
                       <!--{{ BanglaText('cart') }}-->
                       <!-- </a>-->
                                      @if($product->product->type == 'variable' || $product->product->prod_color == 'varcolor') 
                                      
                                      <a href="{{ route('front.product.show', [ $product->product->id ] ) }}"
                                         style="color: white; font-size: 16px;background: red;border: solid;width: 100%;padding-top: 3%;"
                                         class="btn btn-sm btn-warning semi "
                                         >
                                     {{ BanglaText('order') }}
                                      </a>
                                      
                                      @else
                                      <a href="{{ route('front.check.single', ['product_id' => $product->product->id]) }}"
                                           style="color: white; font-size: 15px;padding-top: 3%;background: red;border: solid;width: 100%;padding-top: 3%;"
                                           class="btn btn-sm btn-warning semi buy-now"
                                           data-url="{{ route('front.cart.store') }}">
                                       <i class="fas fa-shopping-cart"></i> &nbsp;  {{ BanglaText('order') }}
                                        </a>
                                      @endif
                                      
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                                    <div align="center">
                                        <strong class="text-center text-danger">No products are available</strong>
                                    </div>
                                    @endforelse


                    </div>
                </div>
            </section>
        <!-- Products -->
        </div>
    </div>

</div>
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


<!--<script>-->
<!--$(document).ready(function () {-->
<!--    $('.buy-now').on('click', function (e) {-->
<!--        e.preventDefault();-->
        
<!--        var productId = $(this).attr('href').split('/').pop();-->
<!--        var addToCartUrl = $(this).data('url');-->
<!--        var checkoutUrl = "{{ route('front.cart.index') }}";-->
<!--        var csrfToken = $('meta[name="csrf-token"]').attr('content');-->

        <!--// Include CSRF token in AJAX request headers-->
<!--        $.ajaxSetup({-->
<!--            headers: {-->
<!--                'X-CSRF-TOKEN': csrfToken-->
<!--            }-->
<!--        });-->

        <!--// Perform AJAX request to add the product to the cart-->
<!--        $.post(addToCartUrl, { id: productId }, function (response) {-->
            <!--// Redirect to checkout page after adding to cart-->
<!--            window.location.href = checkoutUrl;-->
<!--        });-->
<!--    });-->
<!--});-->
<!--</script>-->

<script>
$(document).ready(function () {
    var urlParams = new URLSearchParams(window.location.search);
    var minPrice = urlParams.get('min_price');
    var maxPrice = urlParams.get('max_price');

    $('#min-price').val(minPrice || 0);
    $('#max-price').val(maxPrice || {{ $maxPrice }});
    $('#min-price-input').val(minPrice || 0);
    $('#max-price-input').val(maxPrice || {{ $maxPrice }});

     $('#availability-filter-form').on('submit', function (e) {
        e.preventDefault();
        var minPrice = $('#min-price').val();
        var maxPrice = $('#max-price').val();
        var inStock = $('#check-1').prop('checked') ? 1 : 0;
        var outOfStock = $('#check-2').prop('checked') ? 1 : 0;

        var redirectUrl = '{{ route('front.shop') }}' +
            '?min_price=' + minPrice +
            '&max_price=' + maxPrice +
            '&in_stock=' + inStock +
            '&out_of_stock=' + outOfStock;

        window.location.href = redirectUrl;
    });

    $('#clear-filter').on('click', function () {
        window.location.href = '{{ route('front.shop') }}';
    });
});

</script>


@endpush

