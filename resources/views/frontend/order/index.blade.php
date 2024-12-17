@extends('frontend.app')
@section('title', 'Order List')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
@endpush
@push('scripts')
  
   
@endpush
@push('scripts')

@endpush

@section('content')
<main>
    <section class="flex items-center justify-center py-2 lg:py-10 bg-gray-100 px-0 lg:px-4">
      <div class="max-w-4xl w-full bg-white rounded-lg shadow-md p-3 lg:p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Your Order Details</h2>
        
        <!-- Responsive Wrapper -->
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr>
                <th class="py-3 px-4 bg-gray-200 text-gray-700 font-semibold border-b">Order #</th>
                <th class="py-3 px-4 bg-gray-200 text-gray-700 font-semibold border-b">Date</th>
                <th class="py-3 px-4 bg-gray-200 text-gray-700 font-semibold border-b">Status</th>
                <th class="py-3 px-4 bg-gray-200 text-gray-700 font-semibold border-b">Total</th>
                <th class="py-3 px-4 bg-gray-200 text-gray-700 font-semibold border-b">Actions</th>
              </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)  
              <tr>
                <td class="py-3 px-4 border-b">#{{ $order->order_id }}</td>
                <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($order->created_at)->format('j M Y / H:i:s') }}</td>
                <td class="py-3 px-4 border-b">
                    @php $s = $order->order_status; @endphp
                    @if($s == 0)
                        <p style="color:yellow;background:black; text-align:center; border-radius:10%; font-weight:bold">Pending</p>
                    @elseif($s == 1)
                        <p style="color:white;background:black; text-align:center; border-radius:10%; font-weight:bold">Progress</p>
                    @elseif($s == 2)
                        <p style="color:Gray; background:black; text-align:center; border-radius:10%; font-weight:bold">Delivered</p>
                    @elseif($s == 3)
                        <p style="color:greenyellow; background:black; text-align:center; border-radius:10%; font-weight:bold">Completed</p>
                    @elseif($s == 4)
                        <p style="color:red; background:black; text-align:center; border-radius:10%; font-weight:bold">Declined</p>
                    @elseif ($s== 5)    
                    <p style="color:red; background:black; text-align:center; border-radius:10%; font-weight:bold">On Hold</p>
                    @elseif ($s== 6)    
                    <p style="color:red; background:black; text-align:center; border-radius:10%; font-weight:bold">Return</p>
                    @elseif ($s== 7)    
                    <p style="color:red; background:black; text-align:center; border-radius:10%; font-weight:bold">Partial</p>
                    @elseif ($s== 8)    
                    <p style="color:red; background:black; text-align:center; border-radius:10%; font-weight:bold">Due</p>
                    @endif

                   
                </td>
                <td class="py-3 px-4 border-b">{{ $order->total_amount }}</td>
                <td class="py-3 px-4 border-b">
                  <a href="{{ route('front.order.show', [$order->id] ) }}" class="text-blue-600 hover:underline">View Details</a>
                  @if(Auth::User())
                  @if(!$s== 6)
                  <a href="{{ route('front.order.return', [$order->id] ) }}" class="text-red-600 hover:underline"> Return Order</a>
                  @endif
                  @endif  

                  @if ($order->payment_method === 'due' || $order->payment_method === 'partial')
                  <a href="{{ route('front.orders.payment', $order->id) }}" class="btn btn-primary">Payment</a>
                  @else
                  <span class="badge bg-success">Paid</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="5">
                      <strong class="text-danger text-center">No orders are available!</strong>
                  </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
    
        {{-- <div class="mt-6">
          <a href="profile.html">
            <button class="bg-blue-800 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Back to Profile</button>
          </a>
        </div> --}}
      </div>
    </section>
    
        
        
  </main>



  <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.3/js/jquery.dataTables.min.js"></script>
    
    <script>
    $(document).ready(function(){
        // Initialize DataTable
        $('#myTable').DataTable({
            // Add any custom DataTable options here
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[ 1, "desc" ]]
        });
    });
</script>
@endsection
