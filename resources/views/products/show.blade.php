@extends('layouts.site')

@section('title', $product['name'] . ' — TonKit.Pro')

@section('content')

    <div class="max-w-7xl mx-auto px-4 py-4 text-xs text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-orange-600">Home</a> /
        <a href="{{ route('products.index') }}" class="hover:text-orange-600">Products</a> /
        <span class="text-orange-600">{{ $product['name'] }}</span>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-16 grid md:grid-cols-2 gap-12">
        <div class="bg-white border rounded-lg p-8">
            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full max-w-md mx-auto">
        </div>

        <div>
            <div class="text-xs text-gray-400 uppercase mb-2">SKU: {{ $product['sku'] }}</div>
            <h1 class="text-3xl font-extrabold">{{ $product['name'] }}</h1>
            <div class="text-2xl font-bold text-orange-600 mt-3">${{ number_format($product['price'], 2) }}</div>

            <p class="text-gray-600 mt-4 leading-relaxed">{{ $product['description'] }}</p>

            <form method="POST" action="{{ route('cart.add', $product['slug']) }}" class="mt-8 flex items-center gap-4">
                @csrf
                <label for="qty" class="text-sm font-semibold">Qty</label>
                <input type="number" name="qty" id="qty" value="1" min="1" class="w-20 border rounded px-3 py-2">
                <button type="submit" class="bg-orange-600 text-white font-semibold px-8 py-3 rounded hover:bg-orange-700">
                    Add to Cart
                </button>
            </form>

            <div class="mt-8 border-t pt-6 text-sm text-gray-500 space-y-2">
                <p>✓ Fast shipping across Canada & USA</p>
                <p>✓ Bulk / corporate order pricing available — <a href="{{ route('contact') }}" class="text-orange-600 hover:underline">contact us</a></p>
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <div class="max-w-7xl mx-auto px-4 pb-16">
            <h2 class="text-xl font-bold mb-6">You May Also Like</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($related as $item)
                    <a href="{{ route('products.show', $item['slug']) }}" class="border rounded-lg p-4 hover:shadow-lg transition bg-white block">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-28 object-contain">
                        <div class="mt-2 text-sm font-semibold">{{ $item['name'] }}</div>
                        <div class="text-orange-600 font-bold text-sm">${{ number_format($item['price'], 2) }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

@endsection
