@extends('layouts.site')

@section('title', $product['name'] . ' — TonKit.Pro')

@section('content')

@php($colors = $product['colors'])

<div class="container-site py-5 text-xs uppercase tracking-wide text-gray-400">
    <a href="{{ route('home') }}" class="hover:text-brand-orange">Home</a>
    <span class="mx-1">/</span>
    <a href="{{ route('products.index') }}" class="hover:text-brand-orange">Inventory</a>
    <span class="mx-1">/</span>
    <span class="text-brand-orange">{{ $product['name'] }}</span>
</div>

<div x-data="{
        colors: {{ Illuminate\Support\Js::from($colors) }},
        active: 0,
        lightbox: false,
        get current() { return this.colors[this.active]; },
        select(i) { this.active = (i + this.colors.length) % this.colors.length; },
     }"
     @keydown.window.escape="lightbox = false"
     @keydown.window.arrow-right="select(active + 1)"
     @keydown.window.arrow-left="select(active - 1)"
     class="container-site pb-16 grid md:grid-cols-2 gap-12">

    {{-- Gallery --}}
    <div>
        <button type="button" @click="lightbox = true"
                class="relative block w-full bg-brand-gray border border-gray-200 rounded-lg p-8 group cursor-zoom-in">
            <span class="badge-new">New</span>
            <img :src="'{{ asset('') }}' + current.image" :alt="current.name + ' {{ $product['name'] }}'"
                 class="w-full max-w-md mx-auto aspect-square object-contain">
            <span class="absolute bottom-3 right-3 h-9 w-9 rounded-full bg-white/90 border border-gray-200 flex items-center justify-center text-brand-dark opacity-0 group-hover:opacity-100 transition-opacity">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
            </span>
        </button>
        <div class="mt-4 grid grid-cols-5 sm:grid-cols-6 gap-2">
            <template x-for="(c, i) in colors" :key="c.slug">
                <button type="button" @click="active = i" @mouseenter="active = i"
                        :class="active === i ? 'border-brand-orange' : 'border-gray-200 hover:border-gray-400'"
                        class="border rounded-md p-1 bg-brand-gray transition-colors">
                    <img :src="'{{ asset('') }}' + c.image" :alt="c.name" class="w-full aspect-square object-contain">
                </button>
            </template>
        </div>
    </div>

    {{-- Details --}}
    <div>
        <div class="text-[11px] font-semibold uppercase tracking-widest text-gray-400 mb-2">
            {{ $product['brand'] }} · SKU {{ $product['sku'] }}
        </div>
        <h1 class="text-3xl font-extrabold leading-tight">{{ $product['name'] }}</h1>

        <div class="text-2xl font-bold text-brand-orange mt-3"><x-price :amount="$product['price']" /></div>

        <p class="text-gray-600 mt-5 leading-relaxed">{{ $product['description'] }}</p>

        {{-- Colours (swatch + label + code) --}}
        <div class="mt-7">
            <div class="text-sm font-bold uppercase tracking-wide mb-3">Colours</div>
            <div class="flex flex-wrap gap-x-4 gap-y-3">
                <template x-for="(c, i) in colors" :key="c.slug">
                    <button type="button" @click="active = i" class="text-left group">
                        <span :class="active === i ? 'border-brand-orange ring-2 ring-brand-orange/30' : 'border-gray-300 group-hover:border-gray-500'"
                              class="block h-12 w-12 rounded border-2" :style="'background-color:' + c.hex"></span>
                        <span class="block text-[11px] font-semibold mt-1 leading-tight" x-text="c.name"
                              :class="active === i ? 'text-brand-dark' : 'text-gray-500'"></span>
                        <span class="block text-[10px] text-gray-400 leading-tight" x-text="c.code || ''"></span>
                    </button>
                </template>
            </div>
        </div>

        {{-- Add to cart --}}
        <form method="POST" action="{{ route('cart.add', $product['slug']) }}" class="mt-7 flex flex-wrap items-end gap-4">
            @csrf
            <input type="hidden" name="color" :value="current.slug">
            <div>
                <label for="qty" class="block text-sm font-semibold uppercase tracking-wide mb-1">Qty</label>
                <input type="number" name="qty" id="qty" value="1" min="1"
                       class="w-20 rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
            </div>
            <button type="submit" class="btn-orange">Add to Cart</button>
        </form>

        {{-- Specs --}}
        @if (! empty($product['specs']))
            <div class="mt-9">
                <h2 class="text-sm font-bold uppercase tracking-wide mb-3">Specifications</h2>
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($product['specs'] as $label => $value)
                            <tr>
                                <th class="text-left font-semibold text-gray-500 py-2 pr-4 w-32 align-top uppercase text-[11px] tracking-wide">{{ $label }}</th>
                                <td class="py-2 text-brand-dark">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-8 border-t border-gray-200 pt-6 text-sm text-gray-500 space-y-2">
            <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Fast shipping across Pakistan</p>
            <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Bulk / corporate pricing — <a href="{{ route('contact') }}" class="text-brand-orange hover:underline">contact us</a></p>
            <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Custom embroidery &amp; printing available</p>
        </div>
    </div>

    {{-- Lightbox --}}
    <div x-show="lightbox" x-cloak
         class="fixed inset-0 z-[100] bg-black/90 flex items-center justify-center p-4"
         @click.self="lightbox = false" x-transition.opacity>
        <button type="button" @click="lightbox = false" aria-label="Close"
                class="absolute top-4 right-4 h-11 w-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <button type="button" @click="select(active - 1)" aria-label="Previous"
                class="absolute left-2 sm:left-6 h-12 w-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
        </button>
        <button type="button" @click="select(active + 1)" aria-label="Next"
                class="absolute right-2 sm:right-6 h-12 w-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </button>
        <div class="text-center">
            <img :src="'{{ asset('') }}' + current.image" :alt="current.name"
                 class="max-h-[80vh] max-w-[90vw] object-contain mx-auto">
            <div class="mt-3 text-white text-sm font-semibold" x-text="current.name"></div>
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
