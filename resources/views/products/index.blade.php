@extends('layouts.site')

@section('title', 'Online Inventory — TonKit.Pro')

@section('content')

    {{-- ── Hero banner ────────────────────────────────────────── --}}
    <section class="hero-banner">
        <div class="container-site py-12 relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold">ONLINE <span class="text-brand-orange">INVENTORY</span></h1>
            <p class="text-gray-300 mt-2 max-w-xl">TonKit.Pro: Your trusted source for Flexfit, Mitchell &amp; Ness, Crep Protect, and more.</p>
        </div>
    </section>

    {{-- ── Breadcrumb + toolbar ───────────────────────────────── --}}
    <div class="container-site py-6 flex flex-wrap items-center justify-between gap-3 border-b border-gray-100">
        <nav class="text-xs uppercase tracking-wide text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-brand-orange">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-brand-orange">Shop</a>
            <span class="mx-1">/</span>
            <span class="text-brand-orange">TonKit Headwear</span>
        </nav>
        <p class="text-sm text-gray-500">Showing all {{ $products->count() }} result{{ $products->count() === 1 ? '' : 's' }}</p>
    </div>

    {{-- ── Shop grid ──────────────────────────────────────────── --}}
    <div class="container-site py-10 grid lg:grid-cols-[260px_1fr] gap-10">

        {{-- Sidebar --}}
        <aside class="space-y-6">
            <div class="border border-gray-200 rounded-md p-5">
                <div class="flex items-center gap-2 text-sm font-bold uppercase tracking-wide text-brand-dark">
                    <svg class="h-4 w-4 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/></svg>
                    Filters
                </div>
                <form action="{{ route('products.index') }}" method="GET" class="mt-4">
                    <label class="text-xs text-gray-500">Category</label>
                    <select name="cat" class="mt-1 w-full rounded border-gray-300 text-sm focus:border-brand-orange focus:ring-brand-orange">
                        <option>TonKit Headwear ({{ count(config('products.list')) }})</option>
                    </select>
                    @if ($query !== '')
                        <input type="hidden" name="q" value="{{ $query }}">
                    @endif
                </form>
            </div>

            <div class="bg-brand-gray rounded-md p-6 text-center">
                <div class="mx-auto h-12 w-12 rounded-full bg-white flex items-center justify-center">
                    <svg class="h-6 w-6 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                </div>
                <div class="mt-3 font-bold uppercase text-sm">Need Help?</div>
                <p class="text-xs text-gray-500 mt-1">If you have questions, please contact your local sales rep.</p>
                <a href="{{ route('contact') }}" class="btn-orange w-full mt-4 !py-2.5">Contact Us</a>
            </div>

            <div class="border border-gray-200 rounded-md p-5 space-y-4">
                @foreach ([
                    ['t' => 'Fast Shipping', 'd' => 'Across Canada & USA'],
                    ['t' => 'Quality Guaranteed', 'd' => '100% Authentic Products'],
                    ['t' => 'Bulk Orders', 'd' => 'Corporate & Team Orders'],
                    ['t' => 'Customer Support', 'd' => 'We\'re Here to Help'],
                ] as $f)
                    <div class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-brand-orange shrink-0"></span>
                        <div>
                            <div class="text-sm font-bold text-brand-dark">{{ $f['t'] }}</div>
                            <div class="text-xs text-gray-500">{{ $f['d'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>

        {{-- Products --}}
        <div>
            @if ($products->isEmpty())
                <div class="border border-dashed border-gray-300 rounded-md p-12 text-center text-gray-500">
                    No products matched <span class="font-semibold text-brand-dark">"{{ $query }}"</span>.
                    <a href="{{ route('products.index') }}" class="text-brand-orange hover:underline">View all</a>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @include('partials.feature-strip')

@endsection
