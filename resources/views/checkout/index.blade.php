@extends('layouts.site')

@section('title', 'Checkout — TonKit.Pro')

@section('content')

    <div class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-extrabold mb-8">Checkout</h1>

        <div class="border rounded-lg p-6 mb-8">
            @foreach ($items as $item)
                <div class="flex justify-between py-2 border-b last:border-b-0">
                    <span>{{ $item['name'] }} × {{ $item['qty'] }}</span>
                    <span class="font-semibold">${{ number_format($item['price'] * $item['qty'], 2) }}</span>
                </div>
            @endforeach
            <div class="flex justify-between pt-4 mt-2 border-t font-bold text-lg">
                <span>Total</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('checkout.paypal') }}">
            @csrf
            <button type="submit" class="w-full bg-[#ffc439] text-gray-900 font-bold py-4 rounded hover:bg-[#f0b429] flex items-center justify-center gap-2">
                Pay with PayPal
            </button>
        </form>

        <p class="text-xs text-gray-500 mt-4 text-center">
            You'll be redirected to PayPal to complete your payment securely, then brought back here to confirm your order.
        </p>
    </div>

@endsection
