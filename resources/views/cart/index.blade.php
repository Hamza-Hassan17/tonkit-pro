@extends('layouts.site')

@section('title', 'Your Cart — CapBeast')

@section('content')

    <x-page-hero title="YOUR" accent="CART" subtitle="Review your bulk order before checkout." />

    <div class="container-site py-12">
        @if (empty($items))
            <div class="max-w-xl mx-auto text-center py-10">
                <div class="mx-auto h-16 w-16 rounded-full bg-brand-gray flex items-center justify-center">
                    <svg class="h-7 w-7 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.87-4.706 2.25-7.187a1.125 1.125 0 00-1.087-1.313H5.106M7.5 14.25 5.106 5.25"/></svg>
                </div>
                <h2 class="text-xl font-extrabold mt-4">Your cart is empty</h2>
                <p class="text-gray-500 mt-1">Browse our inventory and build a bulk order to get started.</p>
                <a href="{{ route('products.index') }}" class="btn-orange mt-6">Shop the Catalog</a>

                <div class="mt-14 text-left">
                    <div class="text-center text-brand-orange text-xs font-bold uppercase tracking-[0.3em] mb-6">Popular Right Now</div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach (\App\Http\Controllers\ProductController::all()->take(4) as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="grid lg:grid-cols-[1fr_360px] gap-10 items-start">

                {{-- Items --}}
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="hidden sm:grid grid-cols-[1fr_130px_130px_40px] gap-4 px-6 py-3 bg-brand-gray text-[11px] font-bold uppercase tracking-wide text-gray-500">
                        <span>Product</span><span class="text-center">Quantity</span><span class="text-right">Line total</span><span></span>
                    </div>
                    @foreach ($breakdown['lines'] as $item)
                        <div class="grid sm:grid-cols-[1fr_130px_130px_40px] gap-4 items-center px-6 py-5 border-t border-gray-100 first:border-t-0 sm:first:border-t">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-contain bg-brand-gray rounded shrink-0">
                                <div>
                                    <a href="{{ route('products.show', $item['slug']) }}" class="font-semibold hover:text-brand-orange leading-snug">{{ $item['name'] }}</a>
                                    @if ($item['color_name'])
                                        <div class="text-xs text-gray-500 mt-0.5 flex items-center gap-1.5">
                                            <span class="h-3 w-3 rounded-full ring-1 ring-black/10" style="background-color: {{ $item['color_hex'] }}"></span>
                                            {{ $item['color_name'] }}
                                        </div>
                                    @endif
                                    @if ($item['decoration'] !== 'none')
                                        <div class="text-xs text-gray-500 mt-0.5">{{ $item['decoration_label'] }}</div>
                                    @endif
                                    @if ($item['decoration'] === 'print')
                                        <div class="text-[11px] font-semibold text-red-600 mt-0.5">{{ config('pricing.decoration.print.warning') }}</div>
                                    @endif
                                    <div class="text-brand-orange font-bold text-sm mt-0.5">
                                        <x-price :amount="$item['unit_price']" /> <span class="text-gray-400 font-normal">/ cap · {{ $item['tier_label'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('cart.update', $item['slug']) }}" class="flex items-center justify-center gap-2">
                                @csrf @method('PATCH')
                                <input type="hidden" name="color" value="{{ $item['color'] }}">
                                <input type="hidden" name="decoration" value="{{ $item['decoration'] }}">
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="{{ config('pricing.moq') }}"
                                       class="w-16 rounded border-gray-300 text-sm text-center focus:border-brand-orange focus:ring-brand-orange">
                                <button type="submit" class="text-xs text-gray-400 hover:text-brand-orange underline">Update</button>
                            </form>
                            <div class="text-right font-bold"><x-price :amount="$item['line_subtotal']" /></div>
                            <form method="POST" action="{{ route('cart.remove', $item['slug']) }}" class="text-right">
                                @csrf @method('DELETE')
                                <input type="hidden" name="color" value="{{ $item['color'] }}">
                                <input type="hidden" name="decoration" value="{{ $item['decoration'] }}">
                                <button type="submit" aria-label="Remove" class="text-gray-300 hover:text-red-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                    <div class="px-6 py-4 border-t border-gray-100">
                        <a href="{{ route('products.index') }}" class="text-sm font-semibold text-brand-orange hover:text-brand-orange-dark">← Continue shopping</a>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="lg:sticky lg:top-28 space-y-4">
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h2 class="font-extrabold text-lg mb-4">Order Summary</h2>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between"><span class="text-gray-500">Caps &amp; decoration ({{ $breakdown['total_qty'] }})</span><span class="font-semibold"><x-price :amount="$breakdown['items_subtotal']" /></span></div>
                            @foreach ($breakdown['setup_fees'] as $fee)
                                <div class="flex justify-between"><span class="text-gray-500">{{ $fee['label'] }}</span><span><x-price :amount="$fee['amount']" /></span></div>
                            @endforeach
                            <div class="flex justify-between">
                                <span class="text-gray-500">Shipping</span>
                                <span>@if ($breakdown['shipping'] > 0)<x-price :amount="$breakdown['shipping']" />@else <span class="text-green-600 font-semibold">Free</span> @endif</span>
                            </div>
                        </div>
                        <div class="flex justify-between pt-4 mt-4 border-t border-gray-200 font-bold text-lg">
                            <span>Total</span><span class="text-brand-orange"><x-price :amount="$breakdown['total']" /></span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn-orange w-full mt-5">Proceed to Checkout</a>
                        <p class="text-xs text-gray-500 mt-2 text-center">No account required — checkout as a guest.</p>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-5 space-y-3 text-xs text-gray-500">
                        @foreach (['Secure card payment via Stripe', 'In-house embroidery & DTF print', 'Free shipping on 145+ caps'] as $t)
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-brand-orange shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75"/></svg>
                                {{ $t }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('partials.feature-strip')

@endsection
