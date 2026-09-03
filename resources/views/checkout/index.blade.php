@extends('layouts.site')

@section('title', 'Checkout — TonKit.Pro')

@section('content')

    <x-page-hero title="CHECK" accent="OUT" subtitle="One secure step to complete your order." />

    <div class="container-site py-12">
        <div class="grid lg:grid-cols-[1fr_380px] gap-10 items-start">

            {{-- Payment panel --}}
            <div class="space-y-6">
                <div class="border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3">
                        <span class="h-9 w-9 rounded-full bg-brand-orange/10 flex items-center justify-center text-brand-orange font-extrabold">1</span>
                        <h2 class="font-extrabold text-lg">Review &amp; pay</h2>
                    </div>
                    <p class="text-sm text-gray-500 mt-3">
                        You'll be redirected to PayPal to complete your payment securely, then brought
                        back here to confirm your order. No card details are stored on our site.
                    </p>

                    <form method="POST" action="{{ route('checkout.paypal') }}" class="mt-6">
                        @csrf
                        <button type="submit" class="w-full bg-[#ffc439] text-[#253b80] font-bold py-4 rounded hover:bg-[#f0b429] transition-colors flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7.4 21.3H4.6c-.3 0-.6-.3-.5-.6L6.7 3.3c0-.3.3-.5.6-.5h6.7c3.2 0 5.3 1.6 4.9 4.7-.5 3.7-3 5.3-6.4 5.3H9.7c-.3 0-.6.2-.6.5l-1.1 7c0 .5-.3.8-.6 1z"/></svg>
                            Pay with PayPal
                        </button>
                    </form>

                    <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        256-bit SSL encrypted checkout
                    </div>
                </div>

                <a href="{{ route('cart.index') }}" class="inline-flex text-sm font-semibold text-brand-orange hover:text-brand-orange-dark">← Back to cart</a>
            </div>

            {{-- Order summary --}}
            <div class="lg:sticky lg:top-28 border border-gray-200 rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-brand-gray">
                    <h2 class="font-extrabold">Order Summary</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-contain bg-brand-gray rounded">
                                    <span class="absolute -top-2 -right-2 bg-brand-dark text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $item['qty'] }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-semibold truncate">{{ $item['name'] }}</div>
                                    <div class="text-xs text-gray-400">${{ number_format($item['price'], 2) }} each</div>
                                </div>
                                <div class="text-sm font-semibold">${{ number_format($item['price'] * $item['qty'], 2) }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-200 space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span class="font-semibold">${{ number_format($total, 2) }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-500">Shipping</span><span class="text-gray-500">Free</span></div>
                    </div>
                    <div class="flex justify-between pt-4 mt-4 border-t border-gray-200 font-bold text-lg">
                        <span>Total</span><span class="text-brand-orange">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
