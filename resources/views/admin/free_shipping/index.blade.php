@extends('admin.master_layout')
@section('title')
<title></title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item"></div>
            </div>
          </div>
           <a href="{{ route('admin.create_free_shipping') }}" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add Free Shipping Product</a>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      

                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                <th>Image</th>
                           
                                <th>Sell Price</th>
                                
                                <th>Discount Amount</th>
                                <th>After Discount</th>
                                <th style="width: 125px;">Action</th>
                                    
                                  </tr>
                            </thead>
                            <tbody style="color:black">
                              @foreach($items as $item)
                            <tr>
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                        
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('uploads/custom-images/'. $item->thumb_image)}}" class="rounded-circle avatar-xs" alt="friend">
                                    </div>
                                        
                                </td>
                             
                                <td>{{$item->price}}</td>
                                
                                <td>{{$item->dicount_amount}}</td>
                                <td>{{$item->offer_price}}</td>
                                <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                                <td>
                               
                                    
                             
                                
                                
                                <button type="button" value="{{ $item->id }}" id="delete_fr_shipping" class="btn btn-danger">Delete</button>
                                    
                               
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript">

$(document).on('click', '#delete_fr_shipping', function (){
    let id = $(this).val();
    $.ajax({
            url: "{{ route('admin.free-shipping.fshippingdestroy')}}",
            type: 'GET',
            dataType: "json",
            data: {product_id: id},
            success: function( res ) {
                
                if(res.status==true){
                toastr.success(res.msg);
                window.location.reload();
                }
                
                            }
          });
});


</script>
@endsection
