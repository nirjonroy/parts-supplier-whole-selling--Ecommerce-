<div class="table-responsive table-invoice">
    <table class="table table-striped table-responsive">
        <thead style="font-size:12px">
                                        <tr>
                                            <th width="" style="width:0px">
                                                 <input type="checkbox" class="check_all" value="">
                                            <!--<div class="form-check">-->
                                            <!--  <label class="form-check-label">-->
                                            <!--    <input type="checkbox" class="form-check-input check_all" value="">-->
                                            <!--  </label>-->
                                            <!--</div>-->
                                          </th>
                                            <th style="width: 11% !important;" class="sortingAc">{{__('admin.Action')}}</th>
                                            <th width="" class="sortingid">ID</th>
                                            <th width="" >{{__('admin.Customer')}}</th>
                                            <th width="" >{{__('admin.Date')}}</th>
                                            <!--<th width="10%">Order Delivery Date</th>-->
                                          	<th width="" >SKU</th>
                                            <th width="" >QTY</th>
                                            <th width="" >{{__('admin.Amount')}}</th>
                                            <th width="" >{{__('admin.Order Status')}}</th>
                                            <th width="" >Order Note</th>
        									<th>Courier</th>
                                            <th width="" >Assign Order id</th>
                                          </tr>
                                    </thead>
                                        <tbody style="color:black; font-size:12px" >
        
                                        @foreach ($received_order as $index => $order)
                                        @if(!empty($order->assign_user_id == Auth::user()->id))
                                        @if(Auth::user()->hasRole('Employee'))
                                            <tr>
                                                <td>
                                                <input type="checkbox" class="order_checkbox" value="{{ $order->id}}">
                                                </td>
                                                <td>
        
                                                <a href="{{ route('admin.order-show',$order->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
        										<a href="{{ route('admin.order-edit',$order->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                               
                                               @if(auth()->user()->can('admin.delete-order'))                                    
                                                	<a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $order->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
        										@endif
                                                </td>
                                                <td>{{ $order->order_id }}</td>
                                                <td>
                                                  {{ $order->orderAddress->shipping_name }}
                                                  {{ $order->orderAddress->shipping_phone }}
                                                  {{ $order->orderAddress->shipping_address }}
        
                                              	</td>
        
                                                <td>{{ $order->created_at->format('d F, Y') }}</td>
                                                <!--<td>{{ $order->ordered_delivery_date }}</td>-->
                                                <td>
                                              	    @foreach ($order->orderProducts as $orderProduct)
                                                    @if(!empty($orderProduct->product->sku)) 
                                                    {{ $orderProduct->product->sku }},
                                                    @else
                                                    Unavailable
                                                    @endif
                                                @endforeach
                                              	</td>
                                                <td>{{ $order->product_qty }}</td>
                                              	 
        
                                                <td>{{ $setting->currency_icon }}{{ round($order->total_amount) }}</td>
                                              	
                                                
                                                <td>
                                                    @if ($order->order_status == 1)
                                                    <span class="badge badge-success">Process</span>
                                                    @elseif ($order->order_status == 2)
                                                    <span class="badge badge-success">Courier</span>
                                                    @elseif ($order->order_status == 3)
                                                    <span class="badge badge-success">Completed</span>
                                                    @elseif ($order->order_status == 4)
                                                    <span class="badge badge-danger">Cancell</span>
                                                    @elseif($order->order_status == 5)
                                                    <span class="badge badge-danger">On Hold</span>
                                                    @elseif($order->order_status == 6)
                                                    <span class="badge badge-danger">Return</span>
                                                    @else
                                                    <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->note ? $order->note : '' }}</td>                                      
                                                <td>
                                                    @if($order->courier_id == '3')
                                                    SteadFast
                                                    {{ $order->courier_tracking_id }}
                                                    @elseif($order->courier_id == '2')
                                                    Pathao
                                                    {{ $order->courier_tracking_id }}
                                                    @elseif($order->courier_id == '1')
                                                    Redx
                                                    {{ $order->courier_tracking_id }}
                                                    @else
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                  @if(!empty($order->assign->name))
                                                  {{$order->assign->name}}
                                                  @endif
                                                </td>
                                            </tr>
        
                                            @endif
        
                                            @endif
        
                                            @if(Auth::user()->hasRole(['Client_test', 'Admin']))
                                            <tr>
                                                <td>
                                                <input type="checkbox" class="order_checkbox" value="{{ $order->id}}">
        
                                              </td>
                                              
                                              <td>
        
                                                <a href="{{ route('admin.order-show',$order->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
        										<a href="{{ route('admin.order-edit',$order->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                @if(auth()->user()->can('admin.delete-order'))                                       
                                                	<a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $order->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
        										@endif                              
                                                </td>
                                              
                                                <td>{{ $order->order_id }}</td>
                                               @if(!empty($order->user->name))
                                              	 <td>
                                                  {{ $order->orderAddress->shipping_name }}
                                                  {{ $order->orderAddress->shipping_phone }}
                                                  {{ $order->orderAddress->shipping_address }}
        
                                              	</td>
                                              @endif
        
                                                <td>
                                                    @php
                                                        $now = \Carbon\Carbon::now(); // Get the current time
                                                        $orderCreatedAt = \Carbon\Carbon::parse($order->created_at); // Parse the order creation time
                                                        $timeDifference = $now->diffInHours($orderCreatedAt); // Calculate the time difference in hours
                                                    @endphp
                                              		 @if ($timeDifference <= 24)
                                                   @if ($timeDifference == 0)
        
        												 <span class="badge badge-success">Less than an hour ago</span>
                                                      @elseif ($timeDifference == 1)
                                      					<span class="badge badge-success">1 hr ago</span>
        
                                                      @else
                                      					<span class="badge badge-success">{{ $timeDifference }} hrs ago</span>
        
                                                      @endif
                                                    @elseif ($timeDifference <= 12)
                                                    <span class="badge badge-success">{{ $orderCreatedAt->format('h:i A') }}</span>
        
                                                    @else
                                                    <span class="badge badge-danger">{{ $orderCreatedAt->format('d M, Y') }}</span>
                                                    @endif
                                              	</td>
                                                <!--<td>{{ $order->ordered_delivery_date }}</td>-->
                                                <td>
                                                @foreach ($order->orderProducts as $orderProduct)
                                                    @if(!empty($orderProduct->product->sku)) 
                                                    {{ $orderProduct->product->sku }},
                                                    @else
                                                   
                                                    @endif
                                                @endforeach
                                                </td>
        
                                                <td>{{ $order->product_qty }}</td>
        
                                                <td>{{ $setting->currency_icon }}{{ round($order->total_amount) }}</td>
                                                <td>
                                                    @if ($order->order_status == 1)
                                                    <span class="badge badge-success">Process</span>
                                                    @elseif ($order->order_status == 2)
                                                    <span class="badge badge-success">Courier</span>
                                                    @elseif ($order->order_status == 3)
                                                    <span class="badge badge-success">Completed</span>
                                                    @elseif ($order->order_status == 4)
                                                    <span class="badge badge-danger">Cancell</span>
                                                    @elseif($order->order_status == 5)
                                                    <span class="badge badge-danger">On Hold</span>
                                                    @elseif($order->order_status == 6)
                                                    <span class="badge badge-danger">Return</span>
                                                    @else
                                                    <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->note ? $order->note : '' }}</td>                                      
                                                <td>
                                                    @if($order->courier_id == '3')
                                                    SteadFast
                                                    {{ $order->courier_tracking_id }}
                                                    @elseif($order->courier_id == '2')
                                                    Pathao
                                                    {{ $order->courier_tracking_id }}
                                                    @elseif($order->courier_id == '1')
                                                    Redx
                                                    {{ $order->courier_tracking_id }}
                                                    @else
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                  @if(!empty($order->assign->name))
                                                  {{$order->assign->name}}
                                                  @endif
                                                </td>
                                            </tr>
                                            @endif
        
                                          @endforeach
                                    </tbody>
    </table>
</div>
<script>
    $(".check_all").on('change',function(){
      $(".order_checkbox").prop('checked',$(this).is(":checked"));
    });
    
</script> 
                            