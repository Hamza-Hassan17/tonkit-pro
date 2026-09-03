@extends('layouts.site')

@section('title', 'Order Confirmed — TonKit.Pro')

@section('content')

    <div class="container-site max-w-2xl py-16 text-center">
        <div class="mx-auto h-16 w-16 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-3xl">✓</div>
        <h1 class="text-2xl font-extrabold mt-5 mb-2">Order Confirmed</h1>
        <p class="text-gray-600 mb-8">Thanks for your order! It's been recorded under order #{{ $order->id }}.</p>

        <div class="border border-gray-200 rounded-lg p-6 text-left">
            @foreach ($order->items as $item)
                <div class="flex justify-between py-2 border-b border-gray-100 last:border-b-0">
                    <span>{{ $item->product_name }} <span class="text-gray-400">× {{ $item->qty }}</span></span>
                    <span class="font-semibold">${{ number_format($item->price * $item->qty, 2) }}</span>
                </div>
            @endforeach
            <div class="flex justify-between pt-4 mt-2 border-t border-gray-200 font-bold text-lg">
                <span>Total</span>
                <span class="text-brand-orange">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('products.index') }}" class="btn-orange">Continue Shopping</a>
            <a href="{{ route('orders.index') }}" class="btn-outline-dark">View My Orders</a>
        </div>
    </div>

@endsection
