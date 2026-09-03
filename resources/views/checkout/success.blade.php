@extends('layouts.site')

@section('title', 'Order Confirmed — TonKit.Pro')

@section('content')

    <div class="container-site max-w-2xl py-16 text-center">
        @php($unpaid = $order && $order->payment_method === 'unpaid')

        <div class="mx-auto h-16 w-16 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-3xl">✓</div>
        <h1 class="text-2xl font-extrabold mt-5 mb-2">
            {{ $unpaid ? 'Order Received' : 'Payment Confirmed' }}
        </h1>

        @if ($order)
            <p class="text-gray-600 mb-8">
                Thanks, {{ $order->contactName() }}! Your order <span class="font-semibold">#{{ $order->id }}</span> has been recorded.
                @if ($unpaid)
                    We'll contact you at <span class="font-semibold">{{ $order->customer_phone }}</span> to arrange payment.
                @else
                    A confirmation has been sent to <span class="font-semibold">{{ $order->contactEmail() }}</span>.
                @endif
            </p>

            <div class="border border-gray-200 rounded-lg p-6 text-left">
                @foreach ($order->items as $item)
                    <div class="flex justify-between py-2 border-b border-gray-100 last:border-b-0">
                        <span>
                            {{ $item->product_name }}
                            @if ($item->color_name)<span class="text-gray-400">({{ $item->color_name }})</span>@endif
                            <span class="text-gray-400">× {{ $item->qty }}</span>
                        </span>
                        <span class="font-semibold"><x-price :amount="$item->price * $item->qty" /></span>
                    </div>
                @endforeach
                <div class="flex justify-between pt-4 mt-2 border-t border-gray-200 font-bold text-lg">
                    <span>Total</span>
                    <span class="text-brand-orange"><x-price :amount="$order->total" /></span>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 text-sm text-gray-500">
                    <div class="font-semibold text-brand-dark">Ship to</div>
                    {{ $order->shipping_address }}
                </div>
            </div>
        @else
            <p class="text-gray-600 mb-8">Your order has been recorded. Thank you for shopping with TonKit.Pro.</p>
        @endif

        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <a href="{{ route('products.index') }}" class="btn-orange">Continue Shopping</a>
            @auth
                <a href="{{ route('orders.index') }}" class="btn-outline-dark">View My Orders</a>
            @endauth
        </div>
    </div>

@endsection
