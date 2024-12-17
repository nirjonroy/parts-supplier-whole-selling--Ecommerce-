@extends('frontend.app')
@section('title')
{{$customPage->page_name}}
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/cart.css') }}">
@endpush

@section('content')
<div class="container">
<h1>{{$customPage->page_name}}</h1>
<p style="text-align:justify">{!!$customPage->description!!}</p>    
</div>



@endsection