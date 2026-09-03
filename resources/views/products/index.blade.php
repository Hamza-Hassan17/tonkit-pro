@extends('layouts.site')

@section('title', 'All Products — TonKit.Pro')

@section('content')

    <div class="bg-gray-900 text-white py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold">ONLINE <span class="text-orange-600">INVENTORY</span></h1>
            <p class="text-gray-400 mt-1">TonKit.Pro: Your Trusted Source for Quality Headwear</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-10">
        <p class="text-sm text-gray-500 mb-6">Showing all {{ $products->count() }} results</p>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg p-4 hover:shadow-lg transition bg-white flex flex-col">
                    <a href="{{ route('products.show', $product['slug']) }}">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-40 object-contain">
                    </a>
                    <div class="mt-3 flex-1">
                        <div class="text-xs text-gray-400 uppercase">TonKit Headwear</div>
                        <a href="{{ route('products.show', $product['slug']) }}" class="font-semibold hover:text-orange-600">
                            {{ $product['name'] }}
                        </a>
                        <div class="text-orange-600 font-bold mt-1">${{ number_format($product['price'], 2) }}</div>
                    </div>
                    <a href="{{ route('products.show', $product['slug']) }}" class="mt-3 block text-center border border-orange-600 text-orange-600 text-xs font-bold uppercase py-2 rounded hover:bg-orange-600 hover:text-white transition">
                        View Product
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
