@extends('frontend.app')
@section('title', 'Sub Category List')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/silck/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush
@section('content')
<main>

    <section class="section-apple-products-categeories my-3">
        <div class="categeories">
            <div class="container">
                <h1 class="text-center border border-1 rounded p-2 text-uppercase ">All  Category</h1>
                <div class="row">
                    @foreach ($allCats as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-1">

                        <div style="border-radius: 24px;" class="card-image border border-1 rounder p-4">
                            <img class="img-fluid" src="{{ asset('uploads/custom-images/'.$item->image) }}" alt="{{ $item->name }}">
                            <a href="{{ route('front.shop', [
                                                              'slug'=> $item->slug
                                                          ] ) }}" class="text-decoration-none ">
                                <p class="text-uppercase text-center fw-bold fs-4 text-dark">{{ $item->name }}</p>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>

        </div>
        </div>
    </section>
</main>



@endsection
