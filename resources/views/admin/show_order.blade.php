@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Invoice')}}</title>
@endsection
<style>
    @media print {
        .section-header,
        #sidebar-wrapper,
        .print-area,
        .main-footer,
        .additional_info {
            display:none!important;
        }
        .status_section {
            display:none!important;
        }
        }
</style>
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Invoice')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Invoice')}}</div>
            </div>
          </div>
          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                        <div class="col-md-6 img_section">
                            <h2 class="invoice-title"><img src="{{ asset($setting->logo) }}" alt="" width="200px"></h2>
                        </div>

                        <div class="col-md-6 text-md-right print-area">
                            <button data-order="{{ $order->id }}" class="btn btn-success btn-icon icon-left print_btn"><i class="fas fa-print"></i> {{__('admin.Print')}}</button>
                            <button class="btn btn-danger btn-icon icon-left" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{ $order->id }})"><i class="fas fa-times"></i> {{__('admin.Delete')}}</button>
                        </div>
                </div>

                    <hr>
                    @php
                        $orderAddress = $order->orderAddress;
                    @endphp
                    <div class="row" >

                        <table class="table table-bordered" border="1">

                            <tbody>
                              <tr>
                                <td>
                                     <address>
                                          <strong>{{__('admin.Shipping Information')}} :</strong><br>
                                          {{ $orderAddress->shipping_name }}<br>
                                            @if ($orderAddress->shipping_email)
                                            {{ $orderAddress->shipping_email }}<br>
                                            @endif
                                            @if ($orderAddress->shipping_phone)
                                            {{ $orderAddress->shipping_phone }}<br>
                                            @endif
                                            {{ $orderAddress->shipping_address }},
                                            {{ $orderAddress->shipping_city.', '. $orderAddress->shipping_state.', '.$orderAddress->shipping_country }}<br>
                                        </address>
                                </td>
                                <td>
                                        <address style="float:right">
                                          <strong>{{__('admin.Order Information')}}:</strong><br>
                                          {{__('admin.Date')}}: {{ $order->created_at->format('d F, Y') }}<br>
                                          Pay with: {{ $order->shipping_method }}<br>
                                        <!--  {{__('admin.Status')}} :-->
                                        <!--  @if ($order->order_status == 1)-->
                                        <!--  <span class="badge badge-success">{{__('admin.Pregress')}} </span>-->
                                        <!--  @elseif ($order->order_status == 2)-->
                                        <!--  <span class="badge badge-success">{{__('admin.Delivered')}} </span>-->
                                        <!--  @elseif ($order->order_status == 3)-->
                                        <!--  <span class="badge badge-success">{{__('admin.Completed')}} </span>-->
                                        <!--  @elseif ($order->order_status == 4)-->
                                        <!--  <span class="badge badge-danger">{{__('admin.Declined')}} </span>-->
                                        <!--  @else-->
                                        <!--  <span class="badge badge-danger">{{__('admin.Pending')}}</span>-->
                                        <!--@endif-->

                                        OrderId: #{{ $order->order_id }}
                                        <br/>
                                        Transacation Id: {!! clean(nl2br($order->transection_id)) !!}
                                        </address>
                                </td>

                              </tr>

                            </tbody>
                        </table>

                      <!--<div class="col-md-6" style="border-right:1px solid black">-->
                      <!--  <address>-->
                      <!--    <strong>{{__('admin.Shipping Information')}} :</strong><br>-->
                      <!--    {{ $orderAddress->shipping_name }}<br>-->
                      <!--      @if ($orderAddress->shipping_email)-->
                      <!--      {{ $orderAddress->shipping_email }}<br>-->
                      <!--      @endif-->
                      <!--      @if ($orderAddress->shipping_phone)-->
                      <!--      {{ $orderAddress->shipping_phone }}<br>-->
                      <!--      @endif-->
                      <!--      {{ $orderAddress->shipping_address }},-->
                      <!--      {{ $orderAddress->shipping_city.', '. $orderAddress->shipping_state.', '.$orderAddress->shipping_country }}<br>-->
                      <!--  </address>-->
                      <!--</div>-->
                      <!--<div class="col-md-6 text-md-right">-->
                      <!--  <address>-->
                      <!--    <strong>{{__('admin.Order Information')}}:</strong><br>-->
                      <!--    {{__('admin.Date')}}: {{ $order->created_at->format('d F, Y') }}<br>-->
                      <!--    {{__('admin.Shipping')}}: {{ $order->shipping_method }}<br>-->
                        <!--  {{__('admin.Status')}} :-->
                        <!--  @if ($order->order_status == 1)-->
                        <!--  <span class="badge badge-success">{{__('admin.Pregress')}} </span>-->
                        <!--  @elseif ($order->order_status == 2)-->
                        <!--  <span class="badge badge-success">{{__('admin.Delivered')}} </span>-->
                        <!--  @elseif ($order->order_status == 3)-->
                        <!--  <span class="badge badge-success">{{__('admin.Completed')}} </span>-->
                        <!--  @elseif ($order->order_status == 4)-->
                        <!--  <span class="badge badge-danger">{{__('admin.Declined')}} </span>-->
                        <!--  @else-->
                        <!--  <span class="badge badge-danger">{{__('admin.Pending')}}</span>-->
                        <!--@endif-->

                      <!--  OrderId: #{{ $order->order_id }}-->
                      <!--  <br/>-->
                      <!--  Transacation Id: {!! clean(nl2br($order->transection_id)) !!}-->
                      <!--  </address>-->
                      <!--</div>-->

                    </div>


                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title">{{__('admin.Order Summary')}}</div>
                    <div class="table-responsive ">
                      <table class="table table-striped table-hover table-md table-bordered" style="border-bottom: 1px solid #F9EDF7;">
                        <tr style="background: #F9EDF7;">
                          <th width="5%">#</th>
                          <th width="25%">{{__('admin.Product')}}</th>
                          {{-- <th width="20%">{{__('admin.Variant')}}</th> --}}
                          @if ($setting->enable_multivendor == 1)
                          <th width="10%">{{__('admin.Shop Name')}}</th>
                          @endif
                          <th width="10%" class="text-center">{{__('admin.Unit Price')}}</th>
                          <th width="10%" class="text-center">{{__('admin.Quantity')}}</th>
                          <th width="10%" class="text-right">{{__('admin.Total')}}</th>
                        </tr>
                        @php
                            $subTotal = 0;
                        $total_discount = 0;
                        @endphp
                        @foreach ($order->orderProducts as $index => $orderProduct)
                            @php
                                $variantPrice = 0;
                                $totalVariant = $orderProduct->orderProductVariants->count();
                            @endphp
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td><a href="">{{ $orderProduct->product_name }}</a></td>
                                {{-- <td>
                                   Color : {{ $orderProduct->variation_color_id }}
                                  Size : {{ $orderProduct->variation }}

                                </td> --}}
                                @if ($setting->enable_multivendor == 1)
                                <td>
                                    @if ($orderProduct->seller)
                                        <a href="{{ route('admin.seller-show',$orderProduct->seller->id) }}">{{  $orderProduct->seller->shop_name }}</a>
                                    @endif
                                </td>
                                @endif
                                <td class="text-center">{{ $setting->currency_icon }}{{ $orderProduct->unit_price }}</td>
                                <td class="text-center">{{ $orderProduct->qty }}</td>
                                @php
                                    $total = ($orderProduct->unit_price * $orderProduct->qty);
                                    $total_discount += $orderProduct->total_discount;

                                @endphp
                                <td class="text-right">{{ $setting->currency_icon }}{{ $total }}</td>
                            </tr>
                            @php
                                $totalVariant = 0;
                            @endphp
                        @endforeach
                      </table>
                    </div>
                    @if ($order->additional_info)
                    <div class="row additional_info">
                        <div class="col">
                            <hr>
                            <h5>{{__('admin.Additional Information')}}: </h5>
                            <p>{!! clean(nl2br($order->additional_info)) !!}</p>
                            <hr>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-lg-12 text-right">
                        @php
                            $sub_total = $order->total_amount;
                            $sub_total = $sub_total - $order->shipping_cost;
                            $sub_total = $sub_total + $order->coupon_coast;

                        @endphp
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">{{__('admin.Subtotal')}} : {{ $setting->currency_icon }}{{ round($sub_total, 2) }}</div>
                        </div>
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">{{__('admin.Discount')}}(-) : {{ $setting->currency_icon }}{{ round($total_discount, 2) }}</div>
                        </div>
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">{{__('Advance')}}(-) : {{ $setting->currency_icon }}{{ round($order->advance_amount, 2) }}</div>
                        </div>
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">{{__('admin.Shipping')}} : {{ $setting->currency_icon }}{{ round($order->shipping_cost, 2) }}</div>
                        </div>

                        <hr class="mt-2 mb-2" style="color:black">
                        <div class="invoice-detail-item text-right" style="border-top:2px solid black; padding-top: 13px">
                          <div class="invoice-detail-value invoice-detail-value-lg">
                             <span style=" background: #F9EDF7;padding: 5px 30px;">{{__('admin.Total')}} : {{ round($order->total_amount, 2) }}</span>
                              </div>
                        </div>


                      </div>
                      </div>

                      <div class="col-lg-12 order-status d-flex" style="padding-right: 0px;">
                          <div class="col-md-6 status_section">
                        {{-- <div class="section-title" style="margin: 0px;">{{__('admin.Order Status')}}</div>

                        <form action="{{ route('admin.update-order-status',$order->id) }}" method="POST">
                          @csrf
                          @method("PUT")
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                              <label for="">{{__('admin.Payment')}}</label>
                            <select name="payment_status" id="" class="form-control">
                                <option {{ $order->payment_status == 0 ? 'selected' : '' }} value="0">{{__('admin.Pending')}}</option>
                                <option {{ $order->payment_status == 1 ? 'selected' : '' }} value="1">{{__('admin.Success')}}</option>
                            </select>
                          </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                            <label for="">{{__('admin.Order')}}</label>
                            <select name="order_status" id="" class="form-control">
                              <option {{ $order->order_status == 0 ? 'selected' : '' }} value="0">{{__('admin.Pending')}}</option>
                              <option {{ $order->order_status == 1 ? 'selected' : '' }} value="1">{{__('admin.In Progress')}}</option>
                              <option {{ $order->order_status == 2 ? 'selected' : '' }}  value="2">{{__('admin.Delivered')}}</option>
                              <option {{ $order->order_status == 3 ? 'selected' : '' }} value="3">{{__('admin.Completed')}}</option>
                              <option {{ $order->order_status == 4 ? 'selected' : '' }} value="4">{{__('admin.Declined')}}</option>
                            </select>
                          </div>
                              </div>
                          </div>
                          <button class="btn btn-primary" type="submit">{{__('admin.Update Status')}}</button>
                        </form> --}}
                        </div>
                        <div class="col-md-6" style="padding-right: 0px;">

                        </div>
                      </div>

                       @php $footer = DB::table('footers')->first(); @endphp
                       @php $setting = DB::table('settings')->first(); @endphp

                      <hr style="margin-bottom: 15px;margin-top: 0px; color: 2px solid black">

                      <div class="row" style="">
                          <div class="col-md-6 d-flex">
                              <p class="mb-0" style="padding-right: 4px;">Phone Number:</p>
                              <p class="mb-0">{{ $footer->phone }}</p>
                          </div>
                          <div class="col-md-6 d-flex">
                              <p class="mb-0">Authorized Sign</p>
                          </div>
                      </div>

                      <div class="row" >
                        <div class="col-md-12 d-flex" style="background: #F9EDF7;border-radius: 25px;">
                             <div lass="company" style="padding-right: 5px;">
                                <p class="mb-0">Company Name: {{ $setting->site_name }}</p>

                             </div>
                             <span>
                                 |
                             </span>
                             <div class="address pl-2">
                                <p class="mb-0">Address: {{ $footer->address }}</p>
                             </div>
                        </div>
                      </div>

                  </div>
                </div>
              </div>

              <div class="col-lg-12 mt-3 print-area">
                            <table class="table table-centered table-nowrap mb-0" id="product_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order Id</th>
                                      	<th>IP Address</th>
                                        <th>Customer</th>
                                        <th style="">Product</th>
                                        <th style="">Status</th>
                                        <th style="">Assign User</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($orderbyNumber as $orbynum)

                                    <tr>
                                        <td>{{ $orbynum->order_id }}</td>
                                      	<td>{{ $orbynum->ip_address }}</td>
                                      	<td>{{ $orbynum->user->name }}</td>
                                       <td>
                                      	@foreach($orbynum->orderProducts as $line)


                                           {{$line->product_name}}



                                      	<br />
                                       @endforeach
                                          </td>
                                      <td>

                                      	 @if ($orbynum->order_status == 1)
                                            <span class="badge badge-success">{{__('admin.Pregress')}} </span>
                                            @elseif ($orbynum->order_status == 2)
                                            <span class="badge badge-success">{{__('admin.Delivered')}} </span>
                                            @elseif ($orbynum->order_status == 3)
                                            <span class="badge badge-success">{{__('admin.Completed')}} </span>
                                            @elseif ($orbynum->order_status == 4)
                                            <span class="badge badge-danger">{{__('admin.Declined')}} </span>
                                            @else
                                            <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                            @endif
                                      </td>
                                      <td>
                                      		@if(!empty($orbynum->assign->name))
                                          {{$orbynum->assign->name}}
                                          @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div>
              <!--<div class="text-md-right print-area">-->
              <!--  <hr>-->
              <!--  <button class="btn btn-success btn-icon icon-left print_btn"><i class="fas fa-print"></i> {{__('admin.Print')}}</button>-->
              <!--  <button class="btn btn-danger btn-icon icon-left" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{ $order->id }})"><i class="fas fa-times"></i> {{__('admin.Delete')}}</button>-->
              <!--</div>-->
            </div>
          </div>

        </section>
      </div>
      <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-order/") }}'+"/"+id)
        }

        (function($) {
            "use strict";
            $(document).ready(function() {

                $(".print_btn").on("click", function(){

                    var order_id = $(this).data('order');
                    var url = '{{ route('admin.orderPrint')}}';
                    $.ajax({
                        method: 'GET',
                        url: url,
                        data: {order_id},
                        success: function(res) {
                            if(res.status) {
                                $(".custom_click").click();
                                window.print()
                            } else {

                            }
                        }
                    });
                })

            });
        })(jQuery);

    </script>




@endsection
