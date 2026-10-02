<x-admin-layout>
    <x-slot name="title">Products</x-slot>
    <x-slot name="breadcrumb">Products</x-slot>

    <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ $query }}" placeholder="Search name or SKU…"
                   class="rounded-md border-gray-300 text-sm focus:border-brand-orange focus:ring-brand-orange">
            @if ($tag !== '')
                <input type="hidden" name="tag" value="{{ $tag }}">
            @endif
            <button type="submit" class="btn-outline-orange !py-2 text-sm">Search</button>
        </form>
        <a href="{{ route('admin.products.create') }}" class="btn-orange !py-2.5">+ New Product</a>
    </div>

    <div class="flex flex-wrap items-center gap-2 mb-5">
        <a href="{{ route('admin.products.index', ['q' => $query]) }}"
           class="text-xs font-semibold uppercase tracking-wide px-3 py-1.5 rounded-full border {{ $tag === '' ? 'bg-brand-dark text-white border-brand-dark' : 'border-gray-300 text-gray-500 hover:border-brand-orange hover:text-brand-orange' }}">
            All
        </a>
        @foreach ($tags as $t)
            <a href="{{ route('admin.products.index', ['q' => $query, 'tag' => $t->key]) }}"
               class="text-xs font-semibold uppercase tracking-wide px-3 py-1.5 rounded-full border {{ $tag === $t->key ? 'bg-brand-dark text-white border-brand-dark' : 'border-gray-300 text-gray-500 hover:border-brand-orange hover:text-brand-orange' }}">
                {{ $t->label }}
            </a>
        @endforeach
    </div>

    <div class="border border-gray-200 rounded-lg bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-brand-gray text-[11px] uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="text-left px-5 py-2.5"></th>
                    <th class="text-left px-5 py-2.5">Name</th>
                    <th class="text-left px-5 py-2.5">SKU</th>
                    <th class="text-left px-5 py-2.5">From</th>
                    <th class="text-left px-5 py-2.5">Colours</th>
                    <th class="text-left px-5 py-2.5">Tags</th>
                    <th class="px-5 py-2.5"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr class="hover:bg-brand-gray/50">
                        <td class="px-5 py-3">
                            @if ($product->colors->first())
                                <img src="{{ asset($product->colors->first()->image_path) }}" class="h-10 w-10 object-contain bg-brand-gray rounded">
                            @endif
                        </td>
                        <td class="px-5 py-3 font-semibold text-brand-dark">{{ $product->name }}</td>
                        <td class="px-5 py-3 text-gray-500 font-mono text-xs">{{ $product->sku }}</td>
                        <td class="px-5 py-3"><x-price :amount="$product->price" /></td>
                        <td class="px-5 py-3">{{ $product->colors->count() }}</td>
                        <td class="px-5 py-3">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($product->tags as $t)
                                    <span class="{{ $t->badge_class }} text-[9px] font-bold uppercase px-1.5 py-0.5 rounded-full">{{ $t->label }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-brand-orange hover:underline text-xs font-semibold">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Delete this product?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-xs font-semibold ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-5 py-8 text-center text-gray-400">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
</x-admin-layout>
