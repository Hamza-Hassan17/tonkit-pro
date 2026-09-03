@extends('layouts.site')

@section('title', 'TonKit.Pro — Quality Caps & Headwear')

@section('content')

    {{-- ── Hero ───────────────────────────────────────────────── --}}
    <section class="bg-white overflow-hidden">
        <div class="container-site grid md:grid-cols-2 gap-8 items-center py-12 md:py-16 relative">
            <div class="relative z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold leading-[1.05]">
                    QUALITY CAPS<br>
                    <span class="text-brand-orange">BUILT FOR EVERYDAY</span>
                </h1>
                <p class="mt-5 text-gray-600 text-lg">Comfortable. Durable. Customizable to your brand.</p>
                <p class="mt-1 text-gray-500">Discover our selection of caps tailored to your image.</p>
                <div class="mt-7 flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="btn-orange">View Catalog</a>
                    <a href="{{ route('contact') }}" class="btn-outline-dark">Request a Quote</a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-6 md:-right-16 bg-brand-orange rounded-[40%_60%_55%_45%/55%_45%_60%_40%] -z-0"></div>
                <img src="{{ asset('images/products/navy-a-town-trucker.svg') }}" alt="TonKit.Pro Cap"
                     class="relative z-10 mx-auto max-w-xs md:max-w-sm drop-shadow-2xl">
            </div>
        </div>
    </section>

    @include('partials.feature-strip')

    {{-- ── Popular caps ───────────────────────────────────────── --}}
    <section class="container-site py-16">
        <div class="text-center mb-10">
            <div class="text-brand-orange text-xs font-bold uppercase tracking-[0.3em]">Our Selection</div>
            <h2 class="text-3xl md:text-4xl font-extrabold mt-2">Popular Caps</h2>
            <div class="mx-auto mt-3 h-1 w-16 bg-brand-orange rounded"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

@endsection
