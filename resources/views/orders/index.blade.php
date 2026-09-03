@extends('layouts.site')

@section('title', 'My Orders — TonKit.Pro')

@section('content')

    <x-page-hero title="MY" accent="ORDERS" />

    <div class="container-site max-w-3xl py-12">
        @if ($orders->isEmpty())
            <div class="border border-dashed border-gray-300 rounded-lg p-12 text-center text-gray-500">
                You haven't placed any orders yet.
                <a href="{{ route('products.index') }}" class="text-brand-orange hover:underline">Browse caps →</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="border border-gray-200 rounded-lg p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-semibold">Order #{{ $order->id }}</span>
                            <span class="text-[11px] uppercase font-bold px-3 py-1 rounded-full
                                {{ $order->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-500 mb-3">{{ $order->created_at->format('M j, Y g:ia') }}</div>
                        @foreach ($order->items as $item)
                            <div class="flex justify-between text-sm py-1">
                                <span>
                                    {{ $item->product_name }}
                                    @if ($item->color_name)<span class="text-gray-400">({{ $item->color_name }})</span>@endif
                                    <span class="text-gray-400">× {{ $item->qty }}</span>
                                </span>
                                <span><x-price :amount="$item->price * $item->qty" /></span>
                            </div>
                        @endforeach
                        <div class="flex justify-between pt-3 mt-2 border-t border-gray-200 font-bold">
                            <span>Total</span>
                            <span class="text-brand-orange"><x-price :amount="$order->total" /></span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
