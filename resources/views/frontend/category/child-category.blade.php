@extends('frontend.app')
@section('title', 'Child Category List')
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
                            <div class="frontPageBanners">
                                <section class="storiesContainer">
                                    <div class="storiesContent">
                                        <div>
                                            <a href="">
                                                <img src="assets/images/stories/_mpimage.webp" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <section class="bodyWrapper">
                                <div class="categoryHeader">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    
                                                    <a href="{{ route('front.subcategory', [
                                                            'type'=>'subcategory', 
                                                            'slug'=> $categories[0]->category->slug 
                                                        ] ) }}">{{ $categories[0]->category->name ?? ''}}
                                                    </a>
                                                </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ $categories[0]->subCategory->name ?? ''}}
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="category-blocks-wrapper">
                                    <div class="category-links-wrapper">
                                        @forelse($categories as $key => $subCategory)
                                            <a href="{{ route('front.shop', [
                                                            'slug'=> $subCategory->slug 
                                                        ] ) }}" class="category">
                                                <div>
                                                    <div class="imageWrapper">
                                                        @if($subCategory)
                                                        <img src="{{ asset($subCategory->image) }}">
                                                        @else
                                                        <img src="{{ asset('frontend/nothing.png') }}">
                                                        @endif
                                                    </div>
                                                    <div class="name">
                                                        {{ $subCategory->name }}
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                        <strong class="text-center text-danger">No Categories are Available!</strong>
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

@endsection

@push('js')
    <script src="{{ asset('frontend/silck/slick.min.js') }}"></script>
@endpush