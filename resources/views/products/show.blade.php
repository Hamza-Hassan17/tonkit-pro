@extends('layouts.site')

@section('title', $product['name'] . ' — TonKit.Pro')

@section('content')

    <div class="container-site py-5 text-xs uppercase tracking-wide text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-brand-orange">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-brand-orange">Shop</a>
        <span class="mx-1">/</span>
        <span class="text-brand-orange">{{ $product['name'] }}</span>
    </div>

    <div class="container-site pb-16 grid md:grid-cols-2 gap-12">
        <div class="relative bg-brand-gray border border-gray-200 rounded-lg p-10">
            <span class="badge-new">New</span>
            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full max-w-md mx-auto">
        </div>

        <div>
            <div class="text-[10px] font-semibold uppercase tracking-widest text-gray-400 mb-2">TonKit Headwear · SKU {{ $product['sku'] }}</div>
            <h1 class="text-3xl font-extrabold leading-tight">{{ $product['name'] }}</h1>

            @auth
                <div class="text-2xl font-bold text-brand-orange mt-3">${{ number_format($product['price'], 2) }}</div>
            @else
                <div class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-brand-dark bg-brand-gray rounded px-3 py-1.5">
                    <svg class="h-4 w-4 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                    <a href="{{ route('login') }}" class="hover:text-brand-orange">Log in to see pricing &amp; order</a>
                </div>
            @endauth

            <p class="text-gray-600 mt-5 leading-relaxed">{{ $product['description'] }}</p>

            @auth
                <form method="POST" action="{{ route('cart.add', $product['slug']) }}" class="mt-8 flex flex-wrap items-center gap-4">
                    @csrf
                    <label for="qty" class="text-sm font-semibold uppercase tracking-wide">Qty</label>
                    <input type="number" name="qty" id="qty" value="1" min="1" class="w-20 rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
                    <button type="submit" class="btn-orange">Add to Cart</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-orange mt-8">Login to Order</a>
            @endauth

            <div class="mt-8 border-t border-gray-200 pt-6 text-sm text-gray-500 space-y-2">
                <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Fast shipping across Canada &amp; USA</p>
                <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Bulk / corporate pricing — <a href="{{ route('contact') }}" class="text-brand-orange hover:underline">contact us</a></p>
                <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Custom embroidery &amp; printing available</p>
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <div class="container-site pb-16">
            <div class="text-center mb-8">
                <div class="text-brand-orange text-xs font-bold uppercase tracking-[0.3em]">You May Also Like</div>
                <h2 class="text-2xl md:text-3xl font-extrabold mt-2">Related Caps</h2>
                <div class="mx-auto mt-3 h-1 w-16 bg-brand-orange rounded"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($related as $item)
                    <x-product-card :product="$item" />
                @endforeach
            </div>
        </div>
    @endif

    @include('partials.feature-strip')

@endsection
