@extends('admin.master_layout')
@section('title')
<title>Order Reports</title>
<style>
    @media print {
        .section-header,
  		.main-sidebar,
        .print-area,
      .dataTables_length,
        .main-footer,
      	.print-btn,
      	.dataTables_filter,
      	.pagination,
      	#btnExport,
        .additional_info {
            display:none!important;
        }
        .status_section {
            display:none!important;
        }
      #sidebar-wrapper{
      		display: none !important;
      } 
      
      .main-content{
      padding-left: 0px !important;
      
      }
      
        }
</style>

@endsection
@section('admin-content')

<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Order Reports</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">Order Reports</div>
            </div>
          </div>
          
          
           <div class="col-md-12 card no-print print-area">
                        <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between" id="order_report_form" method="GET" action="{{ route('admin.report.order.search') }}">
                            @csrf
                            <div class="col-md-4">
                                <label for="query" class="visually-hidden">Search</label>
                                <input type="search" class="form-control" id="query" placeholder="Search..." name="query" value="{{ old('query') }}">
                            </div>
                          	
                          	
                          
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">Status</label>
                                    <select class="form-select form-control" id="status-select" name="status">
                                        <option selected value="">Choose...</option>
                                        
                                         <option value="0">{{__('admin.Pending')}}</option>
                                    <option  value="1">{{__('admin.In Progress')}}</option>
                                    <option   value="2">{{__('admin.Delivered')}}</option>
                                    <option  value="3">{{__('admin.Completed')}}</option>
                                    <option  value="4">{{__('admin.Declined')}}</option>
                                    
                                    </select>
                                    </select>
                                </div>
                            </div>                            
                             <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">Assign By</label>
                                    <select class="form-select form-control" id="assign" name="assign">
                                        <option selected value="">Choose...</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                                   
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">From:</label>
                                    <input type="date" name="from" id="from" class="form-control"/>
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">To:</label>
                                    <input type="date" name="to" id="to" class="form-control"/>
                                </div>
                            </div>
                            
                            <div class="col-auto">
                                <label for="submit" class="visually-hidden">Submit</label>
                                <input type="submit" class="form-control btn btn-sm btn-primary" value="Submit">
                              
                            </div>
                           <div class="col-auto">
                                <a class="form-control btn btn-sm btn-danger" href="{{route('admin.order.report')}}" style="margin-top:37%">Reset</a>
                          </div>
                        </form>                            
                    </div>
    
         <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                                         
                      

                      <div class="table-responsive table-invoice">
                        <button type="button" class="btn btn-primary" id="btnExport" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" style="float:right; margin-left: 4%;">Export Report
                      </button>
                        <button class="btn btn-info print-btn" style="float: right;margin-left: 2%;">Print</button>
                        <table class="table2excel table table-striped table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    
                                    
                                    <th >Inv. No</th>
                                    <th >Customer</th>
                                    <th >Phone</th>
                                    <th >Address</th>
                                    <th >Product</th>
                                    <th >Qty</th>
                                    <th >Total</th>
                                    
                                    
                                  </tr>
                            </thead>
                            @php $total = 0; @endphp
                            <tbody style="color:black; font-size:11px">
                                @foreach($order_products as $item)
                                <tr>
                                    
                                    <td>#{{ $item->order->order_id }} </td>
                                    <td>{{ $item->order->orderAddress->shipping_name }}</td>
                                    
                                    
                                    <td>{{ $item->order->orderAddress->shipping_phone }} </td>
                                    <td>{{ $item->order->orderAddress->shipping_address }} </td>
                                    <td style="">{{$item->product->name}}</td>
                                    
                                    <td>{{$item->qty}} </td>
                                    @php 
                              		$row_total = $item->unit_price * $item->qty;
                              		$total += $row_total;
                                @endphp
                                <td >{{$total}}</td>
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



<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            let table = document.getElementsByTagName("table");
            console.log(table);
            debugger;
            TableToExcel.convert(table[0], {
                name: 'UserManagement.xlsx',
                sheet: {
                    name: 'Usermanagement'
                }
            });
        });
    });
</script>
<script>
$(document).ready(function(){
    
    $(".print-btn").click(function(){
        print();
    })    

});
  
</script>

@endsection