@extends('frontend.app')
@section('title', 'Shop Product List')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/silck/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
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
                        @forelse($products  as $key => $product)


                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="product_thumb">
                                    {{-- <a class="primary_img" href="{{ route('front.product.show', [ $product->id ] ) }}"><img src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}" alt=""></a> --}}
                                    <a class="secondary_img" href="{{ route('front.product.show', [ $product->id ] ) }}"><img src="{{ asset('uploads/custom-images2/'.$product->thumb_image) }}" alt=""></a>
                                    <!--<div class="action_links">-->
                                    <!--    <ul>-->
                                    <!--        <li class="wishlist"><a href="#" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></a></li>-->
                                    <!--        <li class="compare"><a href="#" title="compare"><i class="fa-solid fa-repeat"></i></a></li>-->
                                    <!--        <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="fa-regular fa-eye"></i></a></li>-->
                                    <!--    </ul>-->
                                    <!--</div>-->
                                </div>
                                <div class="product_content ">
                                    <h4 class="ps-1" style="height: 40px;">

                                        <a href="{{ route('front.product.show', [ $product->id ] ) }}" class="font-16">{{ \Illuminate\Support\Str::limit($product->name, 30)}}</a>
                                    </h4>

                                    <div class="price_box ps-1" style="padding-bottom: 0px;">
                                        @if(empty($product->offer_price))
                                        <span class="current_price">৳{{ $product->price }}</span>

                                        @else
                                        <span class="current_price">৳{{ $product->offer_price }}</span>
                                        <del class="old_price">৳{{ $product->price }}</del>

                                        @endif

                                    </div>
                                    <div class="rounded-0 bg-muted p-2 d-flex justify-content-between">

                        <!--                <a data-id="{{ $product->id }}" data-url="{{ route('front.cart.store') }}" style="color: white;font-size: 12px;" class="btn btn-sm btn-warning semi bg-orange  add-to-cart">-->
                        <!--Add to cart-->
                        <!--</a>-->

                                        @if($product->type == 'variable' || $product->prod_color == 'varcolor')
                      		<a href="{{ route('front.product.show', [ $product->id ] ) }}"
                                         style="color: white; font-size: 16px;background: red;border: solid;width: 100%;padding-top: 4%;"
                                         class="btn btn-sm btn-warning semi "
                                         >
                                     {{ BanglaText('order') }}
                                      </a>
                      	@else

                      	<a href="{{ route('front.check.single', ['product_id' => $product->id]) }}"
                                           style="color: white; font-size: 15px;padding-top: 4%;background: red;border: solid;width: 100%;"
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




@endpush

