@extends('layouts.site')

@section('title', 'Order Confirmed — TonKit.Pro')

@section('content')

    <div class="max-w-2xl mx-auto px-4 py-16 text-center">
        <div class="text-green-600 text-5xl mb-4">✓</div>
        <h1 class="text-2xl font-extrabold mb-2">Order Confirmed</h1>
        <p class="text-gray-600 mb-8">Thanks for your order! A confirmation has been recorded under order #{{ $order->id }}.</p>

        <div class="border rounded-lg p-6 text-left">
            @foreach ($order->items as $item)
                <div class="flex justify-between py-2 border-b last:border-b-0">
                    <span>{{ $item->product_name }} × {{ $item->qty }}</span>
                    <span class="font-semibold">${{ number_format($item->price * $item->qty, 2) }}</span>
                </div>
            @endforeach
            <div class="flex justify-between pt-4 mt-2 border-t font-bold text-lg">
                <span>Total</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <a href="{{ route('products.index') }}" class="inline-block mt-8 bg-orange-600 text-white font-semibold px-8 py-3 rounded hover:bg-orange-700">
            Continue Shopping
        </a>
    </div>

@endsection
