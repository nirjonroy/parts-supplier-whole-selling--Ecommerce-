<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeMarch">
    <!-- Site Title -->
    <title>Soft It Global</title>
    <link rel="stylesheet" href="{{asset('invoice/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/bootstrap/bootstrap.min.css')}}">
</head>

<body>
    
    <style>
        .cs-invoice.cs-style1 {
            height: 900px !important;
        } 
        .cs-container {
            padding: 10px 15px !important;    
            min-height: 100vh;
        }
        
        
    /* Default styles for the "no-print" class */
    .no-print {
        display: block;
    }

    /* Media query to hide the "no-print" class when printing */
    @media print {
        .no-print {
            display: none;
        }
    }
</style>
        
        
    </style>
    <div class="row">
        <div class="col-md-12 text-center no-print">
            <button class="btn btn-secondary btn-sm " style="margin-top: 10px;" id="printBtn"><i class="fa fa-print"></i> Print Invoice</button>
        </div>
    </div>
    
   @foreach($items as $item)
    <div class="cs-container">
        <div class="cs-invoice cs-style1">
            <div class="cs-invoice_in" id="download_section">
                
                @php
                        $orderAddress = $item->orderAddress;
                    @endphp
                    <div class="container">
                    <div class="row" >
                        
                        <div class="col-md-6 img_section">
                            <h2 class="invoice-title"><img src="{{ asset($setting->logo) }}" alt="" width="200px"></h2>
                        </div>
                        
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
                            <td >
                                <address style="float:right">
                          <strong>{{__('admin.Order Information')}}:</strong><br>
                          {{__('admin.Date')}}: {{ $item->created_at->format('d F, Y') }}<br>
                          {{__('admin.Shipping')}}: {{ $item->shipping_method }}<br>
                        

                        OrderId: #{{ $item->order_id }}
                        <br/>
                        Transacation Id: {!! clean(nl2br($item->transection_id)) !!}
                        </address></td>
                            <!--<td>john@example.com</td>-->
                          </tr>
                          
                        </tbody>
                      </table>

                    </div>
                    </div>
                
                
                <div class="cs-table cs-style2">
                    <div class="cs-round_border">
                        <div class="cs-table_responsive">
                            
                            <div class="section-title">{{__('admin.Order Summary')}}</div>
                    <div class="table-responsive ">
                      <table class="table table-striped table-hover table-md table-bordered" style="border-bottom: 1px solid #F9EDF7;">
                        <tr style="background: #F9EDF7;">
                          <th width="5%">#</th>
                          <th width="25%">{{__('admin.Product')}}</th>
                          <th width="20%">{{__('admin.Variant')}}</th>
                          @if ($setting->enable_multivendor == 1)
                          <th width="10%">{{__('admin.Shop Name')}}</th>
                          @endif
                          <th width="15%" class="text-center">{{__('admin.Unit Price')}}</th>
                          <th width="10%" class="text-center">{{__('admin.Quantity')}}</th>
                          <th width="10%" class="text-right">{{__('admin.Total')}}</th>
                        </tr>
                        @php
                            $subTotal = 0;
                        $total_discount = 0;
                        @endphp
                        @foreach ($item->orderProducts as $index => $orderProduct)
                            @php
                                $variantPrice = 0;
                                $totalVariant = $orderProduct->orderProductVariants->count();
                            @endphp
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td><a href="" style="text-decoration: none;color: #000000;">{{ $orderProduct->product_name }}</a></td>
                                <td>
                                   Color : {{ $orderProduct->variation_color_id }}
                                  Size : {{ $orderProduct->variation }}	

                                </td>
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
                           
                        </div>
                    </div>
                    <div class="cs-invoice_footer">
                        <div class="cs-left_footer cs-mobile_hide"></div>
                        <div class="cs-right_footer">
                            
                            <table>
                                <tbody>
                                   @php
                                        $sub_total = $item->total_amount;
                                        $sub_total = $sub_total - $item->shipping_cost;
                                        $sub_total = $sub_total + $item->coupon_coast;

                                    @endphp
                                    <tr class="cs-border_none">
                                        
                                     </tr>
                                     <tr>	                                  
                                        <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">Advance : {{ $setting->currency_icon }}{{ round($item->advance_amount, 2) }}</td> <br />
                                    </tr>
									<tr>	                                  
                                        <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">Sub Total : {{ $setting->currency_icon }}{{ round($sub_total, 2) }}</td> <br />
                                  </tr>
                                  <tr>
                                      <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">Discount : {{ $setting->currency_icon }}{{ round($item->coupon_coast, 2) }}</td> <br />  
                                  </tr>
                                  <tr>
                                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">Shipping :{{ $setting->currency_icon }}{{ round($item->shipping_cost, 2) }}</td>
                                      	
                                    </tr>
                                  
                                  <tr>
                                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">In Total :{{ round($item->total_amount, 2) }}</td>
                                      	
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                
                
                
                <!-- .cs-note -->
            </div>
            <div class="cs-invoice_btns cs-hide_print">
                <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path
              d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
              fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
            <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor"
              stroke-linejoin="round" stroke-width="32" />
            <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
              stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
            <circle cx="392" cy="184" r="24" />
          </svg>
                    <span>Print</span>
                </a>
                <button id="download_btn" class="cs-invoice_btn cs-color2">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <title>Download</title>
            <path d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
              fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
              d="M176 272l80 80 80-80M256 48v288" />
          </svg>
          <span>Download</span>
        </button>
            </div>
        </div>
    </div>
     
  	@endforeach
  	
  	<br/>
  	
    <script src="{{asset('invoice/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('invoice/assets/js/jspdf.min.js')}}"></script>
    <script src="{{asset('invoice/assets/js/html2canvas.min.js')}}"></script>
    <script src="{{asset('invoice/assets/js/main.js')}}"></script>
    
    <script>
          let printBtn = document.querySelector('#printBtn');
          printBtn.addEventListener('click', function(){
              print();
          })
      </script>
    
</body>

</html>