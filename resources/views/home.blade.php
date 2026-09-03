@extends('layouts.site')

@section('title', 'TonKit.Pro — Quality Caps & Headwear')

@section('content')

    <section class="bg-gray-50 border-b overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    QUALITY CAPS<br>
                    <span class="text-orange-600">BUILT FOR EVERYDAY</span>
                </h1>
                <p class="mt-4 text-gray-600">Comfortable. Durable. Customizable to your brand.</p>
                <div class="mt-6 flex gap-4">
                    <a href="{{ route('products.index') }}" class="bg-orange-600 text-white font-semibold px-6 py-3 rounded hover:bg-orange-700">
                        View Catalog
                    </a>
                    <a href="{{ route('contact') }}" class="border border-gray-900 font-semibold px-6 py-3 rounded hover:bg-gray-900 hover:text-white">
                        Request a Quote
                    </a>
                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('images/products/navy-a-town-trucker.svg') }}" alt="TonKit.Pro Cap" class="mx-auto max-w-sm">
            </div>
        </div>
    </section>

    <section class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
            <div>
                <div class="font-bold">Fast Shipping</div>
                <div class="text-gray-400">Across Canada & USA</div>
            </div>
            <div>
                <div class="font-bold">Quality Guaranteed</div>
                <div class="text-gray-400">100% Authentic Products</div>
            </div>
            <div>
                <div class="font-bold">Bulk Orders</div>
                <div class="text-gray-400">Corporate & Team Orders</div>
            </div>
            <div>
                <div class="font-bold">Customer Support</div>
                <div class="text-gray-400">We're Here to Help</div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-14">
        <div class="text-center mb-10">
            <div class="text-orange-600 text-xs font-bold uppercase tracking-widest">Our Selection</div>
            <h2 class="text-3xl font-extrabold mt-1">Popular Caps</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg p-4 hover:shadow-lg transition bg-white flex flex-col">
                    <a href="{{ route('products.show', $product['slug']) }}">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-36 object-contain">
                    </a>
                    <div class="mt-3 flex-1">
                        <a href="{{ route('products.show', $product['slug']) }}" class="text-sm font-semibold hover:text-orange-600">
                            {{ $product['name'] }}
                        </a>
                        <div class="text-orange-600 font-bold mt-1">${{ number_format($product['price'], 2) }}</div>
                    </div>
                    <form method="POST" action="{{ route('cart.add', $product['slug']) }}" class="mt-3">
                        @csrf
                        <button type="submit" class="w-full border border-orange-600 text-orange-600 text-xs font-bold uppercase py-2 rounded hover:bg-orange-600 hover:text-white transition">
                            Add to Cart
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

@endsection
