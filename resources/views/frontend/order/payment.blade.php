
@extends('frontend.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Payment for Order #{{ $order->id }}</h2>
    <div class="mb-4">
        <label>Available Credit:</label>
        <span>{{ Auth::user()->credit }}</span>
    </div>
    
    <div class="mb-4">
        <p class="text-gray-700"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        <p class="text-gray-700"><strong>Paid Amount:</strong> ${{ number_format($order->total_amount - $order->due_amount, 2) }}</p>
        <p class="text-gray-700"><strong>Due Amount:</strong> ${{ number_format($order->due_amount, 2) }}</p>
    </div>

    <form action="{{ route('front.orders.processPayment', $order->id) }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label for="payment_method" class="block text-gray-700 font-medium mb-1">Select Payment Method:</label>
            <select name="payment_method" id="payment_method" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="credit">Credit</option>
                <option value="stripe">Stripe</option>
            </select>
        </div>

        <div>
            <label for="payment_amount" class="block text-gray-700 font-medium mb-1">Payment Amount:</label>
            <input 
                type="number" 
                name="payment_amount" 
                id="payment_amount" 
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                max="{{ $order->due_amount }}" 
                step="0.01" 
                required
            />
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition duration-150">
            Pay Now
        </button>
    </form>
</div>
@endsection
