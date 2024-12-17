@extends('frontend.app')
@section('title', 'Order Details')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endpush

@section('content')

<main>
    <section class="flex items-center justify-center py-10 bg-gray-100 px-4">
        <div class="max-w-5xl w-full bg-white rounded-lg shadow-md p-8" id="pdf">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Order Details</h2>
                <div>
                    <button onclick="printDiv('pdf', 'Order Details')" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500 transition duration-200">Print</button>
                    <button onclick="exportToExcel('exTable')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition duration-200">Export to Excel</button>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700">Order Summary</h3>
                <p class="text-gray-600"><strong>Order Number:</strong> {{ $order->order_id }}</p>
                <p class="text-gray-600"><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                <p class="text-gray-600">
                    <strong>Status:</strong> 
                    @php $s = $order->order_status; @endphp
                    @if($s == 0)
                        <span class="font-medium text-yellow-500 bg-black px-2 py-1 rounded-lg">Pending</span>
                    @elseif($s == 1)
                        <span class="font-medium text-white bg-black px-2 py-1 rounded-lg">Progress</span>
                    @elseif($s == 2)
                        <span class="font-medium text-gray-400 bg-black px-2 py-1 rounded-lg">Delivered</span>
                    @elseif($s == 3)
                        <span class="font-medium text-green-400 bg-black px-2 py-1 rounded-lg">Completed</span>
                    @elseif($s == 4)
                        <span class="font-medium text-red-500 bg-black px-2 py-1 rounded-lg">Declined</span>
                    @elseif($s == 5)
                        <span class="font-medium text-red-500 bg-black px-2 py-1 rounded-lg">On Hold</span>
                    @elseif($s == 6)
                        <span class="font-medium text-red-500 bg-black px-2 py-1 rounded-lg">Return</span>
                    @endif
                </p>
                
                <p class="text-gray-600"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            </div>

            <!-- Shipping Address -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700">Shipping Address</h3>
                <p class="text-gray-600">{{ $order->orderAddress->shipping_name }}</p>
                <p class="text-gray-600">{{ $order->orderAddress->shipping_address }}</p>
                
            </div>

            <!-- Item Details -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700">Items in this Order</h3>
                <div class="mt-4">
                    <table class="table-auto w-full border-collapse border border-gray-200" id="exTable">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-200 px-4 py-2">Product Image</th>
                                <th class="border border-gray-200 px-4 py-2">Product Name</th>
                                <th class="border border-gray-200 px-4 py-2">Quantity</th>
                                <th class="border border-gray-200 px-4 py-2">Unit Price</th>
                                <th class="border border-gray-200 px-4 py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalAmount = 0; @endphp
                            @foreach($order->orderProducts as $item)
                            <tr>
                                <td class="border border-gray-200 px-4 py-2">
                                    <img src="{{ asset('uploads/custom-images2/'.$item->product->thumb_image) }}" alt="Product Image" class="h-16">
                                </td>
                                <td class="border border-gray-200 px-4 py-2">{{ $item->product->name }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $item->qty }}</td>
                                <td class="border border-gray-200 px-4 py-2">${{ number_format($item->unit_price, 2) }}</td>
                                <td class="border border-gray-200 px-4 py-2">${{ number_format($item->unit_price * $item->qty, 2) }}</td>
                            </tr>
                            @php $totalAmount += ($item->unit_price * $item->qty); @endphp
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <td colspan="4" class="text-right font-bold px-4 py-2">Subtotal:</td>
                                <td class="px-4 py-2">${{ number_format($totalAmount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right font-bold px-4 py-2">Shipping:</td>
                                <td class="px-4 py-2">${{ number_format($order->shipping_cost, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right font-bold px-4 py-2">Total:</td>
                                <td class="px-4 py-2">${{ number_format($totalAmount + $order->shipping_cost, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Back to Orders Button -->
            <div class="mt-6">
                <a href="{{ url('order') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-500 transition duration-200">Back to Orders</a>
            </div>
        </div>
    </section>
</main>

<script>
    function exportToExcel(tableId) {
        let tableData = document.getElementById(tableId).outerHTML;
        tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); // Remove links
        tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); // Remove input elements
        let a = document.createElement('a');
        a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`;
        a.download = `order_details_${new Date().getTime()}.xls`;
        a.click();
    }

    function printDiv(divId, title) {
        let printContents = document.getElementById(divId).innerHTML;
        let originalContents = document.body.innerHTML;
        document.body.innerHTML = `<html><head><title>${title}</title></head><body>${printContents}</body></html>`;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

@endsection
