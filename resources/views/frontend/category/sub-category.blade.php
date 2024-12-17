@extends('frontend.app')
@section('title', 'Sub Category List')
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
                                            <a href="sub-categories.html">
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
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ $categories[0]->category->name }}
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="category-blocks-wrapper">
                                    <div class="category-links-wrapper">
                                     @forelse($categories as $key => $subCategory)
                                        <a href="{{ route('front.subcategory', [
                                            'type'=>'childcategory', 
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
    <!-- Modal -->

@endsection

@push('js')
    <script src="{{ asset('frontend/silck/slick.min.js') }}"></script>
@endpush