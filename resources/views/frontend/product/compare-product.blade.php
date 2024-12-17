@extends('frontend.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
@endpush
@section('content')

<div class="main-wrapper">
        <div class="overlay-sidebar"></div>
        <div class="container mt-5 mb-5">
            <div class="row compare justify-content-center bg-white ">

                <table class="table table-bordered">
  <thead>
      <tr>

      <td colspan="4">
         <h3 class="bold" style="text-align: center;">Product Comparison</h3>
         <h6 style="text-align: center;">Find and select products to see the differences and similarities between them</h6>

      </td>

      </tr>
    <tr>
      <th>Image</th>
      <th scope="col">
          <div class="text-center">
                        <img src="{{ asset('uploads/custom-images2/'.$product1->thumb_image) }}" height="300" width="300" alt="" class="img-fluid">
                    </div>
      </th>
      <th scope="col">
          <img src="{{ asset('uploads/custom-images2/'.$product2->thumb_image) }}" height="300" width="300" alt="" class="img-fluid">
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
     <td>Product Name</td>
      <td>
          <h5 class="">{{ $product1->name }}</h5>
      </td>
      <td>
          <h5 class="">{{ $product2->name }}</h5>
      </td>

    </tr>
    <tr>
     <td>Product Price</td>
      <td>
          <h5 class="">{{ $product1->price }} $</h5>
      </td>
      <td>
          <h5 class="">{{ $product2->price }} $</h5>
      </td>
    </tr>


    <tr>
     <td>Product Model-Sku</td>
      <td>
          <h5 class="">
              @if(!empty($product1->sku))
                        <p class="medium">{{ $product1->sku }}</p>
                        @else
                        N/A
                        @endif
          </h5>
      </td>
      <td>
          <h5 class="">
              @if(!empty($product2->sku))
                        <p class="medium">{{ $product2->sku }}</p>
                        @else
                        N/A
                        @endif
          </h5>
      </td>
    </tr>


    {{-- <tr>
     <td>Rating</td>
      <td>
          <!--<h5 class="bold">{{ $product1->price }}</h5>-->
      </td>
      <td>
          <!--<h5 class="bold">{{ $product2->price }}</h5>-->
      </td>
    </tr> --}}

    <tr>
     <td>Specification</td>
      <td>
          <h5 class="">
               @foreach ($specifications1 as $spec1)
                        <span style="font-weight:bold; text-align:justify">{{ $spec1->key->key }} : {{ $spec1->specification }}</span><br/><hr/>

                        @endforeach
          </h5>
      </td>
      <td>
          <h5 class="">
                @foreach ($specifications2 as $spec2)
                        <span style="font-weight:bold; text-align:justify">{{ $spec2->key->key }} : {{ $spec2->specification }}</span><hr/><br/>

                        @endforeach
          </h5>
      </td>
    </tr>

    <tr>
     <td>Availability</td>
      <td>
          <h5 class="">
              @if($product1->qty > $product1->sold_qty)
                        <p class="">

                            In Stock</p>
                        @else
                        <p class="">

                            Stock Out</p>
                        @endif
          </h5>
      </td>
      <td>
          <h5 class="">
               @if($product2->qty > $product2->sold_qty)
                        <p class="">

                            In Stock</p>
                        @else
                        <p class="">

                            Stock Out</p>
                        @endif
          </h5>
      </td>
    </tr>
  </tbody>
</table>



                <!--<div class="col-lg-4 col-md-4 d-lg-block d-md-block d-none p-3">-->
                <!--    <h5 class="bold">Product Comparison</h5>-->
                <!--    <p>Find and select products to see the differences and similarities between them</p>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                    <!--<form action="">-->
                    <!--    <div class="input-group mb-3 mt-2">-->
                    <!--        <input type="text" class="form-control shadow-none border border-muted" placeholder="Search Name">-->
                    <!--        <button class="btn btn-outline-secondary border border-muted border-start-0" type="button"><i class="fas fa-magnifying-glass"></i></button>-->
                    <!--      </div>-->
                    <!--</form>-->
                <!--    <div class="text-center">-->
                <!--        <img src="{{ asset($product1->thumb_image) }}" alt="" class="img-fluid">-->
                <!--        <h5 class="bold">{{ $product1->name }}</h5>-->
                <!--        <h5 class="text-danger bold">{{ $product1->price }}</h5>-->
                <!--        <br>-->
                        <!--<a href="" class="text-muted text-cap font-12">Remove</a>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                    <!--<form action="">-->
                    <!--    <div class="input-group mb-3 mt-2">-->
                    <!--        <input type="text" class="form-control shadow-none border border-muted" placeholder="Search Name">-->
                    <!--        <button class="btn btn-outline-secondary border border-muted border-start-0" type="button"><i class="fas fa-magnifying-glass"></i></button>-->
                    <!--      </div>-->
                    <!--</form>-->
                <!--    <div class=" text-center">-->
                <!--        <img src="{{ asset($product2->thumb_image) }}" alt="" class="img-fluid">-->
                <!--        <h5 class="bold">{{ $product2->name }}</h5>-->
                <!--        <h5 class="text-danger bold">{{ $product1->price }}</h5>-->
                <!--        <br>-->
                        <!--<a href="" class="text-muted text-cap font-12">Remove</a>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="col-lg-4 col-md-4 d-lg-block d-md-block d-none p-3">-->
                <!--    <h5 class="">Model - sku</h5>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-center">-->
                <!--        @if(!empty($product1->sku))-->
                <!--        <p class="medium">{{ $product1->sku }}</p>-->
                <!--        @else-->
                <!--        N/A-->
                <!--        @endif-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-center">-->
                <!--        <p class="medium">{{ $product2->sku }}</p>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 d-lg-block d-md-block d-none p-3">-->
                <!--    <h5 class="">Ratting</h5>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-center">-->
                <!--        <p class="medium"></p>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-center">-->
                <!--        <p class="medium"></p>-->
                <!--    </div>-->
                <!--</div>-->


                <!--<div class="col-lg-4 col-md-4 d-lg-block d-md-block d-none p-3">-->
                <!--    <h5 class="">Specification</h5>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-left">-->
                <!--        @foreach ($specifications1 as $spec1)-->
                <!--        <span style="font-weight:bold; text-align:justify">{{ $spec1->key->key }} : {{ $spec1->specification }}</span><br/><hr/>-->

                <!--        @endforeach-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-left">-->
                <!--         @foreach ($specifications2 as $spec2)-->
                <!--        <span style="font-weight:bold; text-align:justify">{{ $spec2->key->key }} : {{ $spec2->specification }}</span><hr/><br/>-->

                <!--        @endforeach-->
                <!--    </div>-->
                <!--</div>-->



                <!--<div class="col-lg-4 col-md-4 d-lg-block d-md-block d-none p-3">-->
                <!--    <h5 class="">Availability</h5>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-center">-->
                <!--        @if($product1->qty > $product1->sold_qty)-->
                <!--        <p class="medium">-->

                <!--            In Stock</p>-->
                <!--        @else-->
                <!--        <p class="medium">-->

                <!--            Stock Out</p>-->
                <!--        @endif-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-md-4 col-6 p-3">-->
                <!--    <div class="text-center">-->
                <!--          @if($product2->qty > $product2->sold_qty)-->
                <!--        <p class="medium">-->

                <!--            In Stock</p>-->
                <!--        @else-->
                <!--        <p class="medium">-->

                <!--            Stock Out</p>-->
                <!--        @endif-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>

    </div>

@endsection
