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
        get current() { return this.colors[this.active]; }
     }"
     class="container-site pb-16 grid md:grid-cols-2 gap-12">

    {{-- Gallery --}}
    <div>
        <div class="relative bg-brand-gray border border-gray-200 rounded-lg p-8">
            <span class="badge-new">New</span>
            <img :src="'{{ asset('') }}' + current.image" :alt="current.name + ' {{ $product['name'] }}'"
                 class="w-full max-w-md mx-auto aspect-square object-contain">
        </div>
        <div class="mt-4 grid grid-cols-5 sm:grid-cols-6 gap-2">
            <template x-for="(c, i) in colors" :key="c.slug">
                <button type="button" @click="active = i"
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

        {{-- Colors --}}
        <div class="mt-7">
            <div class="text-sm font-bold uppercase tracking-wide">
                Colour: <span class="text-gray-500 font-medium normal-case" x-text="current.name"></span>
            </div>
            <div class="mt-3 flex flex-wrap gap-2">
                <template x-for="(c, i) in colors" :key="c.slug">
                    <button type="button" @click="active = i" :title="c.name"
                            :class="active === i ? 'ring-2 ring-brand-orange ring-offset-2' : 'ring-1 ring-black/10'"
                            class="h-8 w-8 rounded-full" :style="'background-color:' + c.hex"></button>
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
