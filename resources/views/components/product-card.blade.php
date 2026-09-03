@props(['product'])

<div class="product-card group">
    <span class="badge-brand">F</span>
    <span class="badge-new">New</span>

    <a href="{{ route('products.show', $product['slug']) }}" class="block pt-4">
        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
             class="w-full h-40 object-contain transition-transform group-hover:scale-105">
    </a>

    <div class="mt-4 flex-1 text-center">
        <div class="text-[10px] font-semibold uppercase tracking-widest text-gray-400">TonKit Headwear</div>
        <a href="{{ route('products.show', $product['slug']) }}"
           class="mt-1 block text-sm font-semibold text-brand-dark hover:text-brand-orange leading-snug">
            {{ $product['name'] }}
        </a>
        @auth
            <div class="text-brand-orange font-bold mt-1">${{ number_format($product['price'], 2) }}</div>
        @endauth
    </div>

    <div class="mt-4">
        @auth
            <form method="POST" action="{{ route('cart.add', $product['slug']) }}">
                @csrf
                <button type="submit" class="btn-outline-orange w-full">Add to Cart</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-outline-orange w-full">Login to Order</a>
        @endauth
    </div>
</div>
