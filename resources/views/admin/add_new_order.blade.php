@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Products')}}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
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
            <h1>Add New Order</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">Add New Order</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Products')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.addNewOrderStore') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">                     
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-4">
                                  <div class="form-group col-12">
                                    <label>Order Status <span class="text-danger">*</span></label>                                    
                                    <select name="order_status" class="form-control select2" id="brand">
                                      <option value="0">Pending Order</option>
                                      <option  value="1">Processing Orders</option>
                                      <option  value="2">Courier Orders</option>
                                      <option  value="3">Completed Orders</option>
                                      <option  value="4">Cancell Orders</option>
                                      <option value="5">On Hold Orders</option>
                                      <option  value="6">Return Orders</option>
                                    </select>
                                </div>                                   
                                </div>  
                                
                                <div class="col-md-8">
                                <div class="mb-3">
                                    <label>Product Search Here</label>  
                                    <input type="text" id="search2"  class="form-control" placeholder="product search here">
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
                                        <th style="width: 9%;">Size</th>
                                        <th>Color</th>
                                        <th style="width: 15%;">price</th>
                                        <th style="width: 12%;">offer Price</th>
                                        <th style="width: 10%;">QTY</th>
                                        <th>Total</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody class="table-light" id="data">
                                  
                                </tbody>
                            </table>                         
                               
                              <div id="data">

                              </div>
                            
                              </div>
                              <div class="col-md-3">
                                
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label>Customer Name <span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control"  name="shipping_name">
                                </div>
                            </div>
                              
                            <div class="col-md-4">
                                <div class="form-group col-12">
                                  <label>Customer Phone <span class="text-danger">*</span></label>
                                  <input type="text" id="" class="form-control"  name="shipping_phone">
                                </div>
                            </div>
                              
                            <div class="col-md-4">
                               <div class="form-group col-12">
                                    <label>Customer Address <span class="text-danger">*</span></label>
                                    <textarea name="shipping_address" id="" cols="10" rows="5" class="form-control text-area-test"></textarea>
                                </div>
                            </div>
                              
                            <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label>Shipping Method <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="shipping_rule" id="shipping_charge">
                                        <option value="" data-charge="0">Select One</option>
                                        @foreach($shippings as $charge)
                                        <option value="{{ $charge->id }}" data-rule="{{ $charge->shipping_rule }}" data-charge="{{ $charge->shipping_fee }}"> {{ $charge->shipping_rule }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          
                              <div class="col-md-4">
                                  <div class="form-group col-12">
                                    <label  class="form-label">Courier</label>
                                    <select class="form-control" name="courier_id">
                                        <option value="" data-charge="0">Select One</option>
                                        @foreach($couriers as $courier)
                                        <option value="{{ $courier->id }}"> {{ $courier->name }} </option>
                                        @endforeach
                                    </select>
                                    </div> 
                              </div> 
                              
                              <div class="col-md-4">
                              <div class="form-group col-12">
                                    <label  class="form-label">Total</label>
                                <input type="text" class="form-control"  name="total_amount" id="purchase_total"  value="1"/>

                                <input type="hidden" value="0" name="shipping_charge" id="shipping_charge" />
                                <input type="hidden" name="total_qty" id="total_qty" />
                                
                                </div>
                              </div>
                              
                            <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label>Order Note</label>
                                    <textarea name="note" id="" cols="30" rows="10" class="form-control text-area-test"></textarea>
                                </div>
                            </div>
                            
                        </div>
                              
                             <div class="row for_redx d-none">
                             <div class="col-md-12">
                               <h5 class="text-danger mt-3">These fields only for Redx Courier Service</h5>
                             </div> 
                             
                            <div class="col-md-4">
                               <label  class="form-label">Choose Area</label>
                             	<select class="form-control select2" id="area_select">
                                  <option value="">Select One</option>
                                  @foreach($areas as $key=>$area)
                                 <option value="{{ $area['id'] }}" >{{ $area['name'] }}</option>-->
                                  @endforeach
                                </select> 
                            </div>                            
                            <div class="col-md-4">
                                 <label  class="form-label">Area ID</label>
                                 <input type="text" readonly class="form-control" id="area_id" name="redx_area_id" value=""/>
                           </div>                                                      
                            <div class="col-md-4">
                                  <label  class="form-label">Area Name</label>
                                  <input type="text" readonly class="form-control" id="area_name" name="area_name" value=""/>
                            </div>
                          </div>                           
                          <div class="row for_pathao d-none">
                            <div class="col-md-12">
                                <h5 class="text-danger mt-3">These fields only for Pathao Courier Service</h5>
                            </div>  
                            <div class="col-md-3">
                                <label  class="form-label">Choose City</label>
                             	<select class="form-control select2" id="city_select" name="city">
                                 <option value="">Select One</option>
                                  @foreach($cities as $key=>$city)
                                  <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                  @endforeach
                                </select>
                            </div>                           
                           <div class="col-md-3">
                                <label  class="form-label">Choose Zone</label>
                            	<select class="form-control select2" id="zone_select" name="state">
                                 <option value="">Select One</option>
                                </select> 
                            </div>                         
                            <div class="col-md-3">
                               <label  class="form-label">Choose Area</label>
                            	<select class="form-control select2" name="pathao_area_id">
                                  <option value="">Select One</option>
                               </select> 
                            </div>                                                     
                            <div class="col-md-3">
                                 <label  class="form-label">Item Weight</label>
                                  <input type="number" class="form-control" id="weight" step="0.5" min="0.5" max="10" name="weight" value=""/>
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
                </div>
          </div>
        </section>
      </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
  
  var path2 = "{{ route('admin.addNewOrderProduct') }}";
  const products=[];
  
  $( "#search2" ).autocomplete({
        selectFirst: false, //here
        minLength: 3,
        source: function( request, response ) {
          $.ajax({
            url: path2,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
                if (data.length ==0) {
                    toastr.error('Product Or Stock Not Found');
                }
                else if (data.length ==1) {
                    if(products.indexOf(data[0].id) ==-1){
                        landingProductEntry(data[0]);
                        products.push(data[0].id);
                    }
                    $('#search2').val('');
                }else if (data.length >1) {
                    response(data);
                }
            }
          });
        },
        select: function (event, ui) {
           if(products.indexOf(ui.item.id) ==-1){
                landingProductEntry(ui.item);
                products.push(ui.item.id);
            }
           $('#search2').val('');
           return false;
        }
      });

      function landingProductEntry(item)
      {
          $.ajax({
            url: '{{ route("admin.addNewProductEntry")}}',
            type: 'GET',
            dataType: "json",
            data: {id:item.id},
            success: function( res ) {
                if (res.html) {
                   $('tbody#data').append(res.html);
                    calculateSum();
                }
            }
          });
      }

      function productEntry(item){
        $.ajax({
            url: '{{ route("admin.orderProductEntry")}}',
            type: 'GET',
            dataType: "json",
            data: {id:item.id},
            success: function( res ) {
                if (res.html) {
                   $('tbody#data').append(res.html);
                    calculateSum();
                }
            }
          });
        }
  
  $(document).ready(function() {
      
    // calculateSum();
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
  
    $(document).on('blur',".quantity, .unit_price",function(e) {    
        calculateSum();    
    });
    
    $(document).on('change','select[name="variation_color"]',function(e) {
        
        var size_id=Number($(".color_data option:selected").attr('value'));
        var pro_id = Number($(".pro_id").val());
        var color=$(".color_data option:selected").data('color'); 
        $.ajax({
            url: '{{ route("admin.get_variant_price")}}',
            type: 'GET',
            dataType: "json",
            data: {size_id, pro_id},
            success: function( res ) {
                if(res.status) {
                    $('.variation_color_id').val(res.size_name);
                    $('input.offer_price').val(res.price);
                }
            }
          });
        
        var tblrow = $(this).closest('tr');
        tblrow.find('td input.offer_price').val(value);
        let tblrows = $("#product_table tbody tr");
   	
        let sub_total=0;
        let row_discount=0;
        let total_qty = 0;
        let charge=Number($("#shipping_charge option:selected").data('charge'));
        tblrows.each(function (index) {
            let tblrow = $(this);
            let qty=Number(tblrow.find('td input.quantity').val());
            let amount=Number(tblrow.find('td input.price').val());
          	let discount=Number(tblrow.find('td input.offer_price').val());
          	if(discount > 0) {
          	    var row_total=Number(qty *discount);
          	} else {
          	    var row_total=Number(qty *amount);
          	    $('input.offer_price').val(0);
          	}
            tblrow.find('td.row_total').text(row_total.toFixed(2));
            sub_total+=row_total;
            total_qty+=qty;
        });
        sub_total+=charge;
        $('input#purchase_total').val(sub_total.toFixed(2));
        $('input#discount_amount').val(row_discount.toFixed(2));
        $('input#shipping_charge').val(charge.toFixed(2));
        $('input#total_qty').val(total_qty);    
    });
    
    
  
    $(document).on('change',"#shipping_charge",function(e) {
        calculateSum();    
    });
    
    // $(document).on('change',"#shipping_rule",function(e) {
    //     calculateSum();    
    // });  
    
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
  
  $(document).on('click',".remove",function(e) {
        var whichtr = $(this).closest("tr");
        whichtr.remove();  
        calculateSum();    
    });
  
   $(document).on('blur change',".quantity",function(e) {
        let current_stock=Number($(this).val());
        let stock=Number($(this).data('qty'));

        if (current_stock>stock) {
            toastr.error('Product Stock Not Available');
            $(this).val(stock);
            calculateSum();
            return false;
        }
    });
 $(document).on('blur',".quantity, .price, .offer_price",function(e) {
        calculateSum();    
    });
  
 function calculateSum() {
        let tblrows = $("#product_table tbody tr");
        let sub_total=0;
        let row_discount=0;
        let total_qty = 0;
        let charge=Number($("#shipping_charge option:selected").data('charge'));
        tblrows.each(function (index) {
            let tblrow = $(this);
            let qty=Number(tblrow.find('td input.quantity').val());
            let amount=Number(tblrow.find('td input.price').val());
          	let discount=Number(tblrow.find('td input.offer_price').val());
          	if(discount > 0) {
          	    var row_total=Number(qty *discount);
          	} else {
          	    var row_total=Number(qty *amount);
          	    $('input.offer_price').val(0);
          	}
            tblrow.find('td.row_total').text(row_total.toFixed(2));
            sub_total+=row_total;
            total_qty+=qty;
        });
        sub_total+=charge;
        $('input#purchase_total').val(sub_total.toFixed(2));
        $('input#discount_amount').val(row_discount.toFixed(2));
        $('input#shipping_charge').val(charge.toFixed(2));
        $('input#total_qty').val(total_qty);
    } 
</script>
@endsection
