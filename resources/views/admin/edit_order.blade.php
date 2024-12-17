@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Products')}}</title>
@endsection
@section('admin-content')

        <style>
            .remove i {
                color: #ffffff;
            }
            .text-area-test {
                min-height: 60px !important;    
            }
        </style>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Edit Order</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Edit Product')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Products')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.order.update',$order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">                     
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-4">
                                  <div class="form-group col-12">
                                    {{-- <label>Order Status <span class="text-danger">*</span></label>                                    
                                    <select name="order_status" class="form-control select2" id="brand">
                                      <option {{ $order->order_status == 0 ? 'selected' : '' }} value="0">Pending Order</option>
                                      <option {{ $order->order_status == 1 ? 'selected' : '' }} value="1">Processing Orders</option>
                                      <option {{ $order->order_status == 2 ? 'selected' : '' }} value="2">Courier Orders</option>
                                      <option {{ $order->order_status == 5 ? 'selected' : '' }} value="5">On Hold Orders</option>
                                      <option {{ $order->order_status == 3 ? 'selected' : '' }} value="3">Completed Orders</option>
                                      <option {{ $order->order_status == 4 ? 'selected' : '' }} value="4">Cancell Orders</option>
                                      <option {{ $order->order_status == 6 ? 'selected' : '' }} value="6">Return Orders</option>
                                    </select> --}}
                                </div>                                 
                                </div>                                    
                                  </div>                                
                                  
                                </div>
                              </div>
                          <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              
                              <div class="col-md-12">
                              <table class="table table-centered table-nowrap mb-0" id="product_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>                                      
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th style="width: 120px;">Quantity</th>
                                        <th style="width: 150px;">Sell Price</th>
                                        <th style="width: 150px;">Discount</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                    @foreach($order->orderProducts as $products)
                                        <tr>
                                          <td> <img class="rounded-circle" src="{{ asset('uploads/custom-images2/'.$products->product->thumb_image) }}" alt="" width="100px" height="100px"></td>
                                          	
                                            <td>{{ $products->product_name }}</td>
                                            <td>{{ $products->variation_color_id }}</td>
                                            <td>{{ $products->variation }}</td>
                                            <td>
                                                <input class="form-control quantity" name="quantity[]" type="number" value="{{ $products->qty }}" required min="1" data-qty="{{ $products->product->qty }}"/>
                                     			
                                                <input type="hidden" name="product_id[]" value="{{ $products->product_id }}" required/>
                                                <input type="hidden" name="variation_id[]" value=""/>
                                                <input type="hidden" name="order_product_id[]" value="{{ $products->id }}"/>
                                            </td>
                                          <td>
                                            <input type="number" class="form-control unit_price" name="unit_price[]" value="{{ $products->unit_price }}" />
                                          </td>
                                          <td>
                                            <input type="number" class="form-control discount_price" name="discount_price[]" value="{{ $products->product->discount_price }}" />
                                          </td>
                                            <td class="row_total">{{$products->unit_price * $products->qty}}</td>
                                            <td><a class="remove btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a></td>
                                        </tr> 
                                   @endforeach
                                  
                                </tbody>
                                
                                <tfoot>
                                    <tr style="border-top: 2px solid black;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="text" class="form-control total_qty" id="total_qty" value="{{ $order->product_qty }}" disabled>
                                            <input type="hidden" id="total_qty" name="product_qty" value="{{ $order->product_qty }}">
                                        </td>
                                        <td></td>
                                        <td>
                                             <input type="text" class="form-control total_discount" id="total_discount" disabled>
                                             <input type="hidden" class="form-control total_discount" id="total_discount" name="total_discount">
                                            
                                        </td>
                                        <td>
                                            <input type="text" class="form-control total_amount" id="total_amount" value="{{ $order->total_amount }}">
                                        <!--<input type="text" class="form-control total_amount" value="" id="total_amount" name="total_amount" disabled>-->
                                        <input type="hidden" class="form-control total_amount" id="total_amount" name="total_amount" value="{{ $order->total_amount }}">

                                        
                                        </td>
                                    </tr>
                                    <!--<tr style="border-top: 2px solid black;">-->
                                    <!--    <td colspan="1">Total Qty</td>-->
                                    <!--    <td>-->
                                    <!--        <input type="text" class="form-control total_qty" id="total_qty" value="{{ $order->product_qty }}" disabled>-->
                                    <!--    </td>-->
                                    <!--    <td colspan="2">Total Discount</td>-->
                                    <!--    <td>-->
                                    <!--        <input type="text" class="form-control total_discount" id="total_discount" disabled>-->
                                    <!--    <input type="hidden" id="total_amount" name="total_amount" value="{{ $order->total_amount }}">-->
                                    <!--    </td>-->
                                    <!--    <input type="hidden" id="total_qty" name="product_qty" value="{{ $order->product_qty }}">-->
                                    <!--    <td colspan="2">Total Amount</td>-->
                                    <!--    <td>-->
                                    <!--        <input type="text" class="form-control total_amount" id="total_amount" value="{{ $order->total_amount }}" disabled>-->
                                    <!--    <input type="hidden" id="total_amount" name="total_amount" value="{{ $order->total_amount }}">-->
                                    <!--    </td>-->
                                        
                                        
                                    <!--  </tr>-->
                                </tfoot>
                            </table>
                            </div>
                              
                            <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label>Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" id="short_name" class="form-control"  name="short_name" value="{{ $order->orderAddress->shipping_name }}">
                                </div>    
                            </div>
                              
                              <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label>Customer Phone <span class="text-danger">*</span></label>
                                    <input type="text" id="shipping_phone" class="form-control"  name="shipping_phone" value="{{ $order->orderAddress->shipping_phone }}">
                                </div>    
                              </div>
                              
                              <div class="col-md-4">
                              <div class="form-group col-12">
                                    <label>Customer Address <span class="text-danger">*</span></label>
                                    <textarea name="shipping_address" id="" cols="30" rows="10" class="form-control text-area-test">{{ $order->orderAddress->shipping_address }}</textarea>
                                </div>                
                             
                              </div>
                              
                              <div class="col-md-4">
                              <div class="form-group col-12">
                                    <label>Shipping Method <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="shipping_charge_id" id="shipping_charge">
                                        <option value="" data-charge="0">Select One</option>
                                        @foreach($shippings as $charge)
                                        <option value="{{ $charge->id }}" {{ $charge->shipping_rule==$order->shipping_method ?'selected':'' }} data-rule="{{ $charge->shipping_rule }}" data-charge="{{ $charge->shipping_fee }}"> {{ $charge->shipping_rule }} </option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                              
                              
                              <!--<div class="col-md-4">-->
                              <!--<div class="form-group col-12">-->
                              <!--      <label>Customer Name <span class="text-danger">*</span></label>-->
                              <!--      <input type="text" id="short_name" class="form-control"  name="short_name" value="{{ $order->orderAddress->shipping_name }}">-->
                                
                              <!--  	 <label>Customer Phone <span class="text-danger">*</span></label>-->
                              <!--      <input type="text" id="short_name" class="form-control"  name="shipping_phone" value="{{ $order->orderAddress->shipping_phone }}">-->
                              <!--  </div>-->
                              <!--</div>-->
                              
                              <!--<div class="col-md-4">-->
                              <!--<div class="form-group col-12">-->
                              <!--      <label>Shipping Method <span class="text-danger">*</span></label>-->
                              <!--      <select class="form-control select2" name="shipping_charge_id" id="shipping_charge">-->
                              <!--          <option value="" data-charge="0">Select One</option>-->
                              <!--          @foreach($shippings as $charge)-->
                              <!--          <option value="{{ $charge->id }}" {{ $charge->shipping_rule==$order->shipping_method ?'selected':'' }} data-rule="{{ $charge->shipping_rule }}" data-charge="{{ $charge->shipping_fee }}"> {{ $charge->shipping_rule }} </option>-->
                              <!--          @endforeach-->
                              <!--      </select>-->
                              <!--  </div>-->
                              <!--</div>-->
                              
                              <!--<div class="col-md-4">-->
                               
                              <!--<div class="form-group col-12">-->
                              <!--      <label>Customer Address <span class="text-danger">*</span></label>-->
                              <!--      <textarea name="shipping_address" id="" cols="30" rows="10" class="form-control text-area-5">{{ $order->orderAddress->shipping_address }}</textarea>-->
                              <!--  </div>                             -->
                             
                              <!--</div>    -->
                              
                              
                              <div class="col-md-4">
                                  <div class="form-group col-12">
                                    <label  class="form-label">Courier</label>
                                    <select class="form-control" name="courier_id">
                                        <option value="" data-charge="0">Select One</option>
                                        @foreach($couriers as $courier)
                                        <option value="{{ $courier->id }}" {{ $courier->id==$order->courier_id ? 'selected' : '' }}> {{ $courier->name }} </option>
                                        @endforeach
                                    </select>
                                    </div> 
                              </div> 
                              
                              <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label  class="form-label">Courier Tracking ID</label>
                                    <input type="text" class="form-control" value="{{ $order->courier_tracking_id}}" name="courier_tracking_id" />
                                </div>                              
                             </div>
                             
                             <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label  class="form-label">Advance Amount</label>
                                    <input type="text" class="form-control" name="advance_amount" value="{{ $order->advance_amount }}" />
                                </div>                              
                             </div>
                             
                             <div class="col-md-4">
                               
                              <div class="form-group col-12">
                                    <label>Order Note</label>
                                    <textarea name="note" id="" cols="30" rows="10" class="form-control text-area-test">{{ $order->note }}</textarea>
                                </div>                             
                             
                              </div>
                              
                             <div class="row for_redx {{ $order->courier_id != 1 ? 'd-none' : '' }}">
                             <div class="col-md-12">
                                 <h5 class="text-danger mt-3">These fields only for Redx Courier Service</h5>
                             </div> 
                             
                             <div class="col-md-4">
                                <label  class="form-label">Choose Area</label>
                             	<select class="form-control select2" id="area_select">
                                  <option value="">Select One</option>
                                  @foreach($areas as $key=>$area)
                                  <option value="{{ $area['id'] }}" {{ $order->area_id ==  $area['id'] ? 'selected' : '' }}>{{ $area['name'] }}</option>
                                  @endforeach
                                </select> 
                            </div>                            
                            <div class="col-md-4">
                                  <label  class="form-label">Area ID</label>
                                  <input type="text" readonly class="form-control" id="area_id" name="redx_area_id" value="{{ $order->area_id}}"/>
                            </div>                                                      
                            <div class="col-md-4">
                                  <label  class="form-label">Area Name</label>
                                  <input type="text" readonly class="form-control" id="area_name" name="area_name" value="{{ $order->area_name}}"/>
                            </div>
                          </div>                           
                          <div class="row for_pathao {{ $order->courier_id != 2 ? 'd-none' : '' }}">
                            <div class="col-md-12">
                                <h5 class="text-danger mt-3">These fields only for Pathao Courier Service</h5>
                            </div>  
                            <div class="col-md-3">
                                <label  class="form-label">Choose City</label>
                             	<select class="form-control select2" id="city_select" name="city">
                                  <option value="">Select One</option>
                                  @foreach($cities as $key=>$city)
                                  <option value="{{ $city['city_id'] }}" {{ $order->city ==  $city['city_id'] ? 'selected' : '' }}>{{ $city['city_name'] }}</option>
                                  @endforeach
                                </select> 
                            </div>                           
                            <div class="col-md-3">
                                <label  class="form-label">Choose Zone</label>
                             	<select class="form-control select2" id="zone_select" name="state">
                                  <option value="{{ $order->state }}">Select One</option>
                                </select> 
                            </div>                         
                            <div class="col-md-3">
                                <label  class="form-label">Choose Area</label>
                             	<select class="form-control select2" name="pathao_area_id">
                                  <option value="{{ $order->area_id }}">Select One</option>
                                </select> 
                            </div>                                                     
                            <div class="col-md-3">
                                  <label  class="form-label">Item Weight</label>
                                  <input type="number" class="form-control" id="weight" step="0.5" min="0.5" max="10" name="weight" value="{{ $order->weight}}"/>
                            </div>
                          </div>
                        </div>
                            </div>
                          </div>
                          </div>
                                

                               
                                
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
            <div class="row mt-4">
                  <div class="col-lg-12 mt-3">
                      
                      <div class="card">
                    <div class="card-body">
                            <div class="table-responsive table-invoice">
                     <table class="table table-striped" id="dataTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 120px;">Order Id</th>
                                        <th>Product</th>
                                        <th style="width: 120px;">Customer</th>
                                         <th style="width: 120px;">IP Address</th>
                                        <th style="width: 150px;">Status</th>
                                        <th style="width: 150px;">Assign User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($orderbyNumber as $orbynum)
                                    
                                    <tr>
                                        <td>{{ $orbynum->order_id }}</td>
                                        <td>
                                           @foreach($orbynum->orderProducts as $products) 
                                            {{ $products->product_name }},
                                           @endforeach   
                                       </td>
                                       <td>{{ $orbynum->user->name }}</td>
                                      <td>{{ $orbynum->ip_address }}</td>
                                      <td>
                                            @if ($orbynum->order_status == 1)
                                            <span class="badge badge-success">Process</span>
                                            @elseif ($orbynum->order_status == 2)
                                            <span class="badge badge-success">Courier</span>
                                            @elseif ($orbynum->order_status == 3)
                                            <span class="badge badge-success">Completed</span>
                                            @elseif ($orbynum->order_status == 4)
                                            <span class="badge badge-danger">Cancell</span>
                                            @elseif($orbynum->order_status == 5)
                                            <span class="badge badge-danger">On Hold</span>
                                            @elseif($orbynum->order_status == 6)
                                            <span class="badge badge-danger">Return</span>
                                            @else
                                            <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                            @endif
                                        </td>
                                      <td> {{ $orbynum->assign?$orbynum->assign->name:''}} </td>
                                    </tr> 
                                    @endforeach
                                 </tbody>
                            </table>
                            </div>
                            </div>
                            </div>
                            
                        </div>
            </div>      
                  
                </div>
          </div>
        </section>
      </div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
  
  $(document).ready(function() {
      
    calculateSum();
  });
  
  $(document).on('blur change',".quantity",function(e) {
        let current_stock=Number($(this).val());
        let stock = Number($(this).data('qty'));       
        
        if (current_stock>stock) {
            toastr.error('Product Stock Not Available');
            $(this).val(stock);
            calculateSum();
            return false;
        }
       
    });
    
    $(document).on('click', '.remove', function() {
        var delete_tr = $(this).closest('tr');
        delete_tr.remove();
        calculateSum();
    });
  
    $(document).on('blur',".quantity, .unit_price",function(e) {    
     calculateSum();    
    });
  
    $(document).on('change',"#shipping_charge",function(e) {
        calculateSum();    
    });
    
    // $(document).on('change',"#shipping_rule",function(e) {
    //     calculateSum();    
    // });  
  
  
    function calculateSum() {
        var adv_amount = $('input[name="advance_amount"]').val();
        let tblrows = $("#product_table tbody tr");
        let sub_total= 0;
        let row_discount=0;
        // let shipping = $('#cost').val();
        let total_qty = 0;
        // let shipping=Number(tblrows.find('td input.shipping_cost').val());
        let shipping=Number($("#shipping_charge option:selected").data('charge'));        
        tblrows.each(function (index) {
            let tblrow = $(this);
            let qty=Number(tblrow.find('td input.quantity').val());
            let amount=Number(tblrow.find('td input.unit_price').val());
            let discount=Number(tblrow.find('td input.discount_price').val());
            let row_total = parseFloat(qty *amount);
            row_discount+=Number(qty *discount);
            sub_total +=row_total;
            tblrow.find('td.row_total').text(row_total.toFixed(2));    
            total_qty += qty;
        });
        
        sub_total+=shipping;
        
        sub_total = sub_total-adv_amount;
        
        $('input#total_amount').val(sub_total);
        $('input#total_qty').val(total_qty.toFixed(2));
        $('input#total_discount').val(row_discount.toFixed(2));
       // $('input#shipping_charge').val(charge.toFixed(2));
    }
  
    $(function(){
         $(document).on('change', 'select[name="courier_id"]', function(e){
    	let courier_id = $(this).val();
    	if(courier_id == 1)
        {
          	$(document).find('div.for_redx').removeClass('d-none');
          	$(document).find('div.for_pathao').addClass('d-none');
        }    	
    	
    	else if(courier_id == 2)
        {
          	$(document).find('div.for_pathao').removeClass('d-none');
          	$(document).find('div.for_redx').addClass('d-none');
        }
    
    	else {
            $(document).find('div.for_pathao').addClass('d-none');
          	$(document).find('div.for_redx').addClass('d-none');
        }
  });
  
  $(document).on('blur', 'input[name="advance_amount"]', function() {
      
      let adv_amount = $(this).val();
      let total_val = $('#total_amount').val();
      if(adv_amount != null || adv_amount != '') {
          var ultimate_amount = total_val - adv_amount;
      } else {
          ultimate_amount = total_val;
      }
      $('input#total_amount').val(ultimate_amount);
  });
  
  $(document).on('change', '#city_select', function(e){
    let city = $(this).val();
    var url = "{{ route('admin.zonesByCity', ":city") }}";
	url = url.replace(':city', city);
    $.ajax({
        url,
        type: 'GET',
        dataType: "json",
        success: function(res){
          if(res.success)
          {
            let html = "<option value=''>Select One</option>";
            for(let i = 0; i < res.zones.length; i++)
            {
               html += "<option value='"+res.zones[i].zone_id+"' >"+res.zones[i].zone_name+"</option>";
            }
            
            $('#zone_select').html(html);
            
          }
        }
      
    });
    
  });
  
   $(document).on('change', '#zone_select', function(e){
    let zone = $(this).val();
    var url = "{{ route('admin.areasByZone', ":zone") }}";
	url = url.replace(':zone', zone);
    $.ajax({
        url,
        type: 'GET',
        dataType: "json",
        success: function(res){
          if(res.success)
          {
            let html = "<option value=''>Select One</option>";
            for(let j = 0; j < res.areas.length; j++)
            {
               html += "<option value='"+res.areas[j].area_id+"' >"+res.areas[j].area_name+"</option>";
            }
            
            $('select[name="pathao_area_id"]').html(html);
            
          }
        }
      
    });
    
  });
  
//   $(document).ready(function() {
//     $('.select2').select2();
//   });

  $(document).on('change',"#area_select",function(e) {
    let area_id = $(this).val();
    
    let area_name = $("#area_select option:selected").text();
    $("#area_id").val(area_id);
    $("#area_name").val(area_name);
  });
  
  
    });
</script>
@endsection
