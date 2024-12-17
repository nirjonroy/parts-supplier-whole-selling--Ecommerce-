@extends('frontend.app')
@section('title', 'Home')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/cart.css') }}">
@endpush

@section('content')
@php
$totalAmount = 0;
@endphp
<div class="main-wrapper container-fluid">
    <br /> 
    <div class="bg-gradient container-fluid" style="background: linear-gradient(120deg, #053cff 0%, #000000 100%) !important;">
    <div class="col-12 product-header">
        <div class="section_title text-light">
           <a href="" style="color: #218A41;"> <h4 class="semi p-1 m-0 prodCatcus" style="text-align:center">Build Your PC </h4> </a>
        </div>
    </div>
</div>
    <div class="overlay-sidebar">
        
    </div>
    <div class="container-fluid mt-5 mb-5">
        <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="cart-items">
                    @foreach($carts as $key => $c)
                    <input type="hidden" value="{{ $c['category_id'] }}">
                    @endforeach
                    <table class="table table-condensed table-bordered">
                        <thead style="background:#010138; color: white; text-align:center">
                            <tr>
                                <td>Icon</td>
                                <td>Category Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($PC_Builder as $pcb)
                            <tr class="">
                                <td>
                                    @if(!empty($pcb->category->image))
                                    <img src="{{ asset('uploads/custom-images2/'.$pcb->category->image) }}"
                                        class="img-thumbnail" alt="Cinque Terre" width="100px" height="100px">
                                    @endif
                                </td>
                                @if(!empty($pcb->category->name))
                                <td>{{$pcb->category->name}}</td>
                                @endif
                                <td>
                                    @if(!empty($pcb->category->id))
                                    <button data-id="{{ $pcb->category->id }}"
                                        class="btn btn-success choose-category" style="background: #010138;">
                                        Choose
                                    </button>
                                    @endif
                                    @if(!empty($pcb->category->id))
                                    @if (in_array($pcb->category->id, $categoryIdsInCart))
                                    <p class="is_selected_{{ $pcb->category->id }}" style="background: blue; color: white; width: 30%; border-radius: 9px; padding: 5px; margin: 5px;">added</p>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                  @if(!empty($pcb->category->id))
                                    <div class="productShow_{{ $pcb->category->id }}"></div> <!-- Container for product details -->
                                  @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12">
                Pc builder items here
                <table class="table table-bordered">
                    <thead style="background:#010138; color: white;">
                        <tr>
                            <th>Name</th>
                            <th>image</th>
                            <th>Price</th>
                            <th>remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $key => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <img src="{{'uploads/custom-images2/'. $item['image'] }}"
                                    alt="{{ $item['name'] }}" width="100px" height="100px" />
                            </td>
                            <td>
                                {{ $item['price'] }}
                            </td>
                            <td>
                                <div class="remove">
                                    <button class="btn remove-item" data-id="{{ $key }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    
                </table>
                @if(!empty($carts))
                        <a href="{{ route('front.checkout.index') }}" class="btn text-center d-block">
                        </a><a href="{{ route('front.checkout.index') }}"
                            class="text-cap btn bg-blue text-light">Proceed to Checkout <span><i
                                    class="fas fa-arrow-right"></i></span></a>
                    @else
                    @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('.choose-category').on('click', function () {
            var categoryId = $(this).data('id');
            var categoryElement = $('.is_selected_' + categoryId);

            // Check if the category ID exists in the cart
            var categoryIdInCart = cartContainsCategory(categoryId);

            console.log("Clicked category ID:", categoryId);
            console.log("Category ID in cart:", categoryIdInCart);

            if (categoryIdInCart) {
                categoryElement.text('added'); // Show "added" text
            } else {
                categoryElement.text(''); // Hide "added" text
            }

            $.ajax({
                url: "{{ url('choose-pc-builder-product') }}/" + categoryId,
                type: 'GET',
                success: function (data) {
                    // Append the product content below the clicked category
                    $('.productShow_' + categoryId).html(data.view);
                }
            });
        });

        function cartContainsCategory(categoryId) {
            // Iterate through the cart items to check if any item has the specified category ID
            var cartItems = {!! json_encode($carts) !!};
            for (var i = 0; i < cartItems.length; i++) {
                if (cartItems[i]['category_id'] === categoryId) {
                    return true; // Category ID found in the cart
                }
            }
            return false; // Category ID not found in the cart
        }
    });
</script>
@endpush
