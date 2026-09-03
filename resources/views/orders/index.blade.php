@extends('layouts.site')

@section('title', 'My Orders — TonKit.Pro')

@section('content')

    <div class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-extrabold mb-8">My Orders</h1>

        @if ($orders->isEmpty())
            <p class="text-gray-500">You haven't placed any orders yet. <a href="{{ route('products.index') }}" class="text-orange-600 hover:underline">Browse caps →</a></p>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="border rounded-lg p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-semibold">Order #{{ $order->id }}</span>
                            <span class="text-xs uppercase font-bold px-3 py-1 rounded-full
                                {{ $order->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-500 mb-3">{{ $order->created_at->format('M j, Y g:ia') }}</div>
                        @foreach ($order->items as $item)
                            <div class="flex justify-between text-sm py-1">
                                <span>{{ $item->product_name }} × {{ $item->qty }}</span>
                                <span>${{ number_format($item->price * $item->qty, 2) }}</span>
                            </div>
                        @endforeach
                        <div class="flex justify-between pt-3 mt-2 border-t font-bold">
                            <span>Total</span>
                            <span>${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
