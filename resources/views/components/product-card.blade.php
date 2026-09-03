@props(['product'])

@php($colors = $product['colors'] ?? [])
@php($image = $product['image'] ?? ($colors[0]['image'] ?? null))

<div class="product-card group flex flex-col">
    <a href="{{ route('products.show', $product['slug']) }}" class="block pt-2 relative">
        @if (! empty($product['brand']))
            <span class="absolute top-0 left-0 text-[10px] font-bold uppercase tracking-wider text-gray-400">{{ $product['brand'] }}</span>
        @endif
        <img src="{{ asset($image) }}" alt="{{ $product['name'] }}"
             class="w-full h-44 object-contain transition-transform group-hover:scale-105">
    </a>

    <div class="mt-3 flex-1 text-center">
        <a href="{{ route('products.show', $product['slug']) }}"
           class="block text-sm font-semibold text-brand-dark hover:text-brand-orange leading-snug">
            {{ $product['name'] }}
        </a>

        @if (count($colors) > 1)
            <div class="mt-2 flex items-center justify-center gap-1.5">
                @foreach (array_slice($colors, 0, 6) as $c)
                    <span class="h-3 w-3 rounded-full ring-1 ring-black/10" style="background-color: {{ $c['hex'] }}" title="{{ $c['name'] }}"></span>
                @endforeach
                @if (count($colors) > 6)
                    <span class="text-[10px] text-gray-400">+{{ count($colors) - 6 }}</span>
                @endif
            </div>
        @endif

        <div class="text-brand-orange font-bold mt-2"><x-price :amount="$product['price']" /></div>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.show', $product['slug']) }}" class="btn-outline-orange w-full">View Options</a>
    </div>
</div>
