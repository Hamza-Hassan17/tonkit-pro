@extends('layouts.site')

@section('title', $product['name'] . ' — CapBeast')

@section('content')

@php($colors = $product['colors'])
@php($pricingData = [
    'moq'         => config('pricing.moq'),
    'capTiers'    => $product['pricing']['tiers'] ?? [$product['price']],
    'bounds'      => config('pricing.tier_bounds'),
    'tierLabels'  => config('pricing.tier_labels'),
    'decorations' => config('pricing.decoration'),
])

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
        p: {{ Illuminate\Support\Js::from($pricingData) }},
        qty: {{ $pricingData['moq'] }},
        decoration: 'none',
        get current() { return this.colors[this.active]; },
        select(i) { this.active = (i + this.colors.length) % this.colors.length; },
        get tierIdx() {
            for (let i = 0; i < this.p.bounds.length; i++) {
                const [mn, mx] = this.p.bounds[i];
                if (this.qty >= mn && (mx === null || this.qty <= mx)) return i;
            }
            return this.qty < this.p.bounds[0][0] ? 0 : this.p.bounds.length - 1;
        },
        get capUnit() { return this.p.capTiers[this.tierIdx] ?? this.p.capTiers[this.p.capTiers.length - 1]; },
        get decoUnit() { return (this.p.decorations[this.decoration].unit || [0,0,0])[this.tierIdx] ?? 0; },
        get unit() { return this.capUnit + this.decoUnit; },
        get lineSubtotal() { return this.unit * Math.max(this.qty, 0); },
        get setup() { return this.p.decorations[this.decoration].setup || 0; },
        money(n) { return '$' + Number(n).toFixed(2); },
     }"
     @keydown.window.escape="lightbox = false"
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

        <div class="mt-3 text-brand-orange">
            <span class="text-sm text-gray-500">from</span>
            <span class="text-2xl font-bold" x-text="money(p.capTiers[0])"></span>
            <span class="text-sm text-gray-500">/ cap · min {{ $pricingData['moq'] }}</span>
        </div>

        <p class="text-gray-600 mt-5 leading-relaxed">{{ $product['description'] }}</p>

        {{-- Colours --}}
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

        {{-- Bulk order calculator --}}
        <form method="POST" action="{{ route('cart.add', $product['slug']) }}" class="mt-8 border border-gray-200 rounded-lg p-5 space-y-5">
            @csrf
            <input type="hidden" name="color" :value="current.slug">
            <input type="hidden" name="decoration" :value="decoration">

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="qty" class="block text-sm font-semibold uppercase tracking-wide mb-1">Quantity</label>
                    <input type="number" name="qty" id="qty" x-model.number="qty" min="{{ $pricingData['moq'] }}"
                           class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
                    <p class="text-[11px] text-gray-400 mt-1">Minimum {{ $pricingData['moq'] }} caps per order</p>
                </div>
                <div>
                    <label for="decoration" class="block text-sm font-semibold uppercase tracking-wide mb-1">Decoration</label>
                    <select id="decoration" x-model="decoration"
                            class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
                        @foreach ($pricingData['decorations'] as $key => $d)
                            <option value="{{ $key }}">{{ $d['label'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <p x-show="p.decorations[decoration].warning" x-cloak x-text="p.decorations[decoration].warning"
               class="text-xs font-semibold text-red-600 -mt-2"></p>

            {{-- Tier table --}}
            <div class="text-xs">
                <div class="grid grid-cols-3 gap-2 text-center">
                    <template x-for="(lbl, i) in p.tierLabels" :key="lbl">
                        <div :class="tierIdx === i ? 'bg-brand-orange/10 border-brand-orange text-brand-dark' : 'border-gray-200 text-gray-500'"
                             class="border rounded p-2">
                            <div class="font-bold" x-text="lbl"></div>
                            <div x-text="money((p.capTiers[i] ?? p.capTiers[p.capTiers.length-1]) + ((p.decorations[decoration].unit||[0,0,0])[i] ?? 0)) + ' / cap'"></div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Live totals --}}
            <div class="bg-brand-gray rounded p-4 text-sm space-y-1.5">
                <div class="flex justify-between"><span class="text-gray-500">Unit price (<span x-text="p.tierLabels[tierIdx]"></span>)</span><span class="font-semibold" x-text="money(unit)"></span></div>
                <div class="flex justify-between" x-show="decoration !== 'none'"><span class="text-gray-500">— includes <span x-text="p.decorations[decoration].label"></span></span><span x-text="'+' + money(decoUnit)"></span></div>
                <div class="flex justify-between"><span class="text-gray-500"><span x-text="qty"></span> caps</span><span class="font-semibold" x-text="money(lineSubtotal)"></span></div>
                <div class="flex justify-between text-gray-400 text-xs" x-show="setup > 0"><span x-text="'+ ' + p.decorations[decoration].setup_label + ' (one-time)'"></span><span x-text="money(setup)"></span></div>
                <div class="flex justify-between pt-1.5 mt-1.5 border-t border-gray-200 font-bold" x-show="setup > 0">
                    <span>Estimated total (this item)</span><span x-text="money(lineSubtotal + setup)"></span>
                </div>
            </div>

            <button type="submit" class="btn-orange w-full">Add to Cart</button>
            <p class="text-[11px] text-gray-400 text-center">Shipping is calculated at checkout, on your full order. Prices in CAD.</p>
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
            <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Custom embroidery &amp; DTF printing in-house</p>
            <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Volume discounts at 73+ and 145+ caps</p>
            <p class="flex items-center gap-2"><span class="text-brand-orange">✓</span> Free shipping on orders of 145+ caps</p>
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
