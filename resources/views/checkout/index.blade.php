@extends('layouts.site')

@section('title', 'Checkout — TonKit.Pro')

@section('content')

    <x-page-hero title="CHECK" accent="OUT" subtitle="Enter your details and pay securely." />

    <div class="container-site py-12">
        <form method="POST" action="{{ route('checkout.store') }}" class="grid lg:grid-cols-[1fr_380px] gap-10 items-start">
            @csrf

            <div class="space-y-6">
                {{-- Contact + shipping --}}
                <div class="border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="h-9 w-9 rounded-full bg-brand-orange/10 flex items-center justify-center text-brand-orange font-extrabold">1</span>
                        <h2 class="font-extrabold text-lg">Contact &amp; shipping</h2>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded p-3 mb-4">
                            Please check the highlighted fields below.
                        </div>
                    @endif

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold mb-1">Full name</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', $user?->name) }}" required
                                   class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange @error('customer_name') border-red-400 @enderror">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Email</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email', $user?->email) }}" required
                                   class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange @error('customer_email') border-red-400 @enderror">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Phone</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required placeholder="03xx xxxxxxx"
                                   class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange @error('customer_phone') border-red-400 @enderror">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold mb-1">Address</label>
                            <input type="text" name="address_line" value="{{ old('address_line') }}" required placeholder="House / street / area"
                                   class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange @error('address_line') border-red-400 @enderror">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" required
                                   class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange @error('city') border-red-400 @enderror">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Postal code <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                   class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold mb-1">Country</label>
                            <input type="text" name="country" value="{{ old('country', 'Pakistan') }}" required
                                   class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange @error('country') border-red-400 @enderror">
                        </div>
                    </div>

                    @guest
                        <p class="text-xs text-gray-500 mt-4">
                            Have an account? <a href="{{ route('login') }}" class="text-brand-orange hover:underline">Log in</a> to save your order history — or just continue as a guest.
                        </p>
                    @endguest
                </div>

                {{-- Payment --}}
                <div class="border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="h-9 w-9 rounded-full bg-brand-orange/10 flex items-center justify-center text-brand-orange font-extrabold">2</span>
                        <h2 class="font-extrabold text-lg">Payment</h2>
                    </div>
                    <div class="flex items-center gap-3 border border-gray-200 rounded-lg p-4 bg-brand-gray/50">
                        <svg class="h-6 w-6 text-brand-dark shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3M3.75 19.5h16.5A2.25 2.25 0 0022.5 17.25V6.75A2.25 2.25 0 0020.25 4.5H3.75A2.25 2.25 0 001.5 6.75v10.5A2.25 2.25 0 003.75 19.5z"/></svg>
                        <div>
                            <div class="font-semibold text-sm">Credit / debit card</div>
                            <div class="text-xs text-gray-500">You'll be redirected to Stripe's secure page to complete payment.</div>
                        </div>
                    </div>
                    <button type="submit" class="btn-orange w-full mt-5">
                        Pay <x-price :amount="$total" /> securely
                    </button>
                    <div class="mt-3 flex items-center justify-center gap-2 text-xs text-gray-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        Encrypted checkout — we never see your card details
                    </div>
                </div>

                <a href="{{ route('cart.index') }}" class="inline-flex text-sm font-semibold text-brand-orange hover:text-brand-orange-dark">← Back to cart</a>
            </div>

            {{-- Order summary --}}
            <div class="lg:sticky lg:top-28 border border-gray-200 rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-brand-gray"><h2 class="font-extrabold">Order Summary</h2></div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <div class="flex items-center gap-3">
                                <div class="relative shrink-0">
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-contain bg-brand-gray rounded">
                                    <span class="absolute -top-2 -right-2 bg-brand-dark text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $item['qty'] }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-semibold truncate">{{ $item['name'] }}</div>
                                    <div class="text-xs text-gray-400">{{ $item['color_name'] ? $item['color_name'].' · ' : '' }}<x-price :amount="$item['price']" /> each</div>
                                </div>
                                <div class="text-sm font-semibold"><x-price :amount="$item['price'] * $item['qty']" /></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200 space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span class="font-semibold"><x-price :amount="$total" /></span></div>
                        <div class="flex justify-between"><span class="text-gray-500">Shipping</span><span class="text-gray-500">Free</span></div>
                    </div>
                    <div class="flex justify-between pt-4 mt-4 border-t border-gray-200 font-bold text-lg">
                        <span>Total</span><span class="text-brand-orange"><x-price :amount="$total" /></span>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
