@extends('frontend.app')
@section('title', 'Shop Product List')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
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
                                            @if(!empty($products[0]->category))
                                                {{ $products[0]->category->name }}  
                                            @endif                                      
                                            @if(!empty($products[0]->subCategory))
                                            > {{ $products[0]->subCategory->name }} 
                                            @endif                                           
                                            @if(!empty($products[0]->childCategory))
                                            > {{ $products[0]->childCategory->name }}
                                            @endif
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="categorySection miscCategorySection onlyMiscCategorySection">
                                <div class="productPane">
                                    @forelse($products as $key => $product)
                                        @include('frontend.product.single-product', ['product'=>$product] )
                                    @empty
                                    <div align="center">
                                        <strong class="text-center text-danger">No products are available</strong>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->

@endsection

