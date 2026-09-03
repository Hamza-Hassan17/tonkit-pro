@extends('layouts.site')

@section('title', 'About Us — TonKit.Pro')

@section('content')

    <x-page-hero title="ABOUT" accent="US" subtitle="Specialist headwear supplier for teams, companies, and everyday wear." />

    {{-- ── Intro ──────────────────────────────────────────────── --}}
    <section class="container-site py-16 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <div class="text-brand-orange text-xs font-bold uppercase tracking-[0.3em]">Who We Are</div>
            <h2 class="text-3xl font-extrabold mt-2 leading-tight">Quality headwear, sourced and finished for your brand</h2>
            <p class="text-gray-600 leading-relaxed mt-4">
                TonKit.Pro is a specialist headwear supplier, offering a curated selection of caps
                built for comfort, durability, and everyday performance. Whether you're outfitting
                a team, a company, or just want a quality cap for yourself, we've got you covered.
            </p>
            <p class="text-gray-600 leading-relaxed mt-4">
                We work with trusted manufacturing partners to guarantee authentic, high-quality
                products on every order, with custom embroidery and printing options available
                for corporate and team orders.
            </p>
            <a href="{{ route('products.index') }}" class="btn-orange mt-6">Browse the Catalog</a>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 md:-right-10 bg-brand-orange/10 rounded-2xl"></div>
            <div class="relative bg-brand-gray border border-gray-200 rounded-2xl p-10">
                <img src="{{ asset('images/products/navy-lightly-structured-corduroy-5-panel-snapback.svg') }}" alt="TonKit.Pro cap" class="mx-auto max-w-[240px] drop-shadow-xl">
            </div>
        </div>
    </section>

    {{-- ── Stats ──────────────────────────────────────────────── --}}
    <section class="bg-brand-gray">
        <div class="container-site py-14 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            @foreach ([['9+', 'Cap Styles'], ['100%', 'Authentic Products'], ['24h', 'Order Processing'], ['CA / US', 'Fast Shipping']] as [$n, $l])
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold text-brand-orange">{{ $n }}</div>
                    <div class="text-sm text-gray-500 mt-1">{{ $l }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ── Why choose us ──────────────────────────────────────── --}}
    <section class="container-site py-16">
        <div class="text-center mb-10">
            <div class="text-brand-orange text-xs font-bold uppercase tracking-[0.3em]">Why TonKit.Pro</div>
            <h2 class="text-3xl font-extrabold mt-2">Built for teams, made simple</h2>
            <div class="mx-auto mt-3 h-1 w-16 bg-brand-orange rounded"></div>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ([
                ['t' => 'Curated Selection', 'd' => 'Every cap in our inventory is picked for fit, materials, and durability — no filler.', 'p' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['t' => 'Custom Branding', 'd' => 'Embroidery and print options to put your logo on any style, on any order size.', 'p' => 'M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42'],
                ['t' => 'Bulk Pricing', 'd' => 'Corporate and team rates scale with your order. Request a quote and we handle the rest.', 'p' => 'M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z'],
            ] as $c)
                <div class="border border-gray-200 rounded-lg p-8 hover:shadow-lg transition-shadow">
                    <div class="h-12 w-12 rounded-full bg-brand-orange/10 flex items-center justify-center">
                        <svg class="h-6 w-6 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['p'] }}"/></svg>
                    </div>
                    <h3 class="font-bold text-lg mt-4">{{ $c['t'] }}</h3>
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">{{ $c['d'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    @include('partials.feature-strip')

@endsection
