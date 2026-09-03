@extends('layouts.site')

@section('title', 'Your Cart — TonKit.Pro')

@section('content')

    <div class="max-w-5xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-extrabold mb-8">Your Cart</h1>

        @if (empty($items))
            <p class="text-gray-500">Your cart is empty. <a href="{{ route('products.index') }}" class="text-orange-600 hover:underline">Browse caps →</a></p>
        @else
            <div class="space-y-4">
                @foreach ($items as $item)
                    <div class="flex items-center gap-4 border rounded-lg p-4">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-contain">
                        <div class="flex-1">
                            <div class="font-semibold">{{ $item['name'] }}</div>
                            <div class="text-orange-600 font-bold text-sm">${{ number_format($item['price'], 2) }}</div>
                        </div>
                        <form method="PATCH" action="{{ route('cart.update', $item['slug']) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="w-16 border rounded px-2 py-1">
                            <button type="submit" class="text-xs text-gray-500 hover:text-orange-600 underline">Update</button>
                        </form>
                        <div class="w-24 text-right font-bold">${{ number_format($item['price'] * $item['qty'], 2) }}</div>
                        <form method="POST" action="{{ route('cart.remove', $item['slug']) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-end">
                <div class="w-full max-w-sm border rounded-lg p-6">
                    <div class="flex justify-between mb-4">
                        <span class="font-semibold">Subtotal</span>
                        <span class="font-bold text-lg">${{ number_format($total, 2) }}</span>
                    </div>
                    @auth
                        <a href="{{ route('checkout.index') }}" class="block text-center bg-orange-600 text-white font-semibold py-3 rounded hover:bg-orange-700">
                            Proceed to Checkout
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block text-center bg-orange-600 text-white font-semibold py-3 rounded hover:bg-orange-700">
                            Login to Order
                        </a>
                        <p class="text-xs text-gray-500 mt-2 text-center">You'll need an account to complete checkout.</p>
                    @endauth
                </div>
            </div>
        @endif
    </div>

@endsection
