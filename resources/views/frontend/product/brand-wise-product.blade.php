@extends('frontend.app')
@section('title', 'Shop Product List')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush
@section('content')
<div class="main-wrapper container">
    <section class="bodyTable">
        <div>
            <div class="catalogBrowser">
                <div class="loaded">
                    <div>
                        <div class="normalBanner d-none">
                            <div class="categoryTopBanner">
                                <div class="fade-carousel-container">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('frontend/images/banners/_mpimage.webp') }}" style="background-color:transparent;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <section class="bodyWrapper">
                            <div class="categoryHeader">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">     
                                            <!--@if($products->count())                                   -->
                                            <!--<span class="text-danger">Brand :</span> -->
                                            <!--{{ $products[0]->brand->name }}-->
                                            <!--@endif-->

                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            
                            
                            
                            <div class="container-fluid p-0">
                              <div class="product-box">
                                 <div class="product_slider">
                                    @forelse($products as $key => $product)
                        
                                     <div class="product-item" style="">
                <div class="product_thumb bg-white prd_img" style="">
                    <a class="primary_img " href="{{ route('front.product.show', [ $product->id ] ) }}"><img src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}" class="primcusImg" alt=""></a>
                    <a class="secondary_img " href="{{ route('front.product.show', [ $product->id ] ) }}"><img src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}" class="seccusImg" alt=""></a>
                    
                    @if($product->offer_price > 0)
                    <div class="label_product" style="width: 102px;">
                        <span class="label_sale" style="padding-top: 2px;">{{ BanglaText('offer') }}</span>
                    </div>
                    @endif
                    @if($product->is_free_shipping > 0)
                    <div class="label_product" style="width: 102px; background:#3276B1; left: 0%; border-radius: 5px 30px 30px 5px">
                        <span class="label_sale" style="padding-top: 2px;">{{ BanglaText('free') }}</span>
                    </div>
                    @endif
                </div>
                <div class="product_content " style="border-top:3px solid #EDEDEF; ">
                    <h4 class="ps-1" style="height: 35px;">
                        <a href="{{ route('front.product.show', [ $product->id ] ) }}" class="font-14" style="font-size:14px"> {{ \Illuminate\Support\Str::limit($product->name, 40)}}</a>
                    </h4>
                    <div class="subText" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.3">
                        
                    </div>
                    <div class="price_box ps-1 justify-content-center prd_prc_bx" style="">
                        @if(empty($product->offer_price))
                        <span class="current_price"> {{$product->price}}</span>
                        @else
                        <span class="current_price">৳ {{$product->offer_price}}</span>
                        <span class="old_price">৳{{$product->price}}</span>
                        @endif
                    </div>
                    <div class="rounded-0 bg-muted p-2 d-flex justify-content-between">
                        
                        <!--<a data-id="{{ $product->id }}" data-url="{{ route('front.cart.store') }}" style="color: white;font-size: 11px;" class="btn btn-sm btn-warning semi bg-orange  add-to-cart">-->
                        <!--    Add to cart-->
                        <!--</a>-->
                      
                       @if($product->type == 'variable' || $product->prod_color == 'varcolor') 
                      		<a href="{{ route('front.product.show', [ $product->id ] ) }}"
                                         style="color: white; font-size: 16px;background:#03259d; border: solid;width: 100%;padding-top: 4%;"
                                         class="btn btn-sm btn-warning semi "
                                         >
                                     {{ BanglaText('order') }}
                                      </a>
                      	@else
                      	
                      	<a href="{{ route('front.check.single', ['product_id' => $product->id]) }}"
                                           style="color: white; font-size: 15px;padding-top: 4%; background:#03259d; border: solid;width: 100%;"
                                           class="btn btn-sm btn-warning semi buy-now"
                                           data-url="{{ route('front.cart.store') }}">
                                       <i class="fas fa-shopping-cart"></i> &nbsp;  {{ BanglaText('order') }}
                                        </a>
                      
                      	@endif
                        
                    </div>
                </div>
            </div>
                                    @empty
                                    @endforelse
                                 </div>
                              </div>
                           </div>
    </section>
</div>
<!-- Modal -->

@endsection


@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
 $(function () {

    $(document).on('click', '.add-to-cart', function (e) {
        let id = $(this).data('id');
        let url = $(this).data('url');
        addToCart(url, id);
    });

    // ... other click event handlers ...

    function addToCart(url, id, variation = "", type = "", quantity = 1) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: { id, quantity, variation },
            success: function (res) {
                if (res.status) {
                    toastr.success(res.msg);
                    if (type) {
                        if (res.url != '') {
                            document.location.href = res.url;
                        } else {
                            // Handle specific case
                        }
                    } else {
                        window.location.reload();
                    }
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

