@extends('frontend.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
@endpush
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container mt-3">

  <div class="mt-4 p-5 bg-primary text-white rounded text-center" style="margin-bottom: 5%; box-shadow: 10px 10px 5px gray; background:#9d0303 !important">
    <h1>Thanks For order</h1>
    <p>Your Order Has Been Received </p>
    <p> Our Sales Representative Will contact you, to ensure this order </p>
    @if(!empty($order_inv->order_id))
    <p> For Your Order. Invoice Number is : #{{$order_inv->order_id}} </p>
    @else


    @endif
    <a class="btn bg-dark" href="{{route('front.home')}}" style="color:white"> Back To Home  </a>
    @if(!empty($order_inv->order_phone))
    <a class="btn bg-dark" href="{{route('front.order-list',$order_inv->order_phone)}}" style="color:white"> See all Orders  </a>
    @else

    @endif
  </div>
</div>

@endsection
