<x-admin-layout>
    <x-slot name="title">Tags</x-slot>
    <x-slot name="breadcrumb">Tags</x-slot>

    <div class="flex justify-end mb-5">
        <a href="{{ route('admin.tags.create') }}" class="btn-orange !py-2.5">+ New Tag</a>
    </div>

    <div class="border border-gray-200 rounded-lg bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-brand-gray text-[11px] uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="text-left px-5 py-2.5">Badge</th>
                    <th class="text-left px-5 py-2.5">Label</th>
                    <th class="text-left px-5 py-2.5">Key</th>
                    <th class="text-left px-5 py-2.5">Blocks Ordering</th>
                    <th class="text-left px-5 py-2.5">Products</th>
                    <th class="px-5 py-2.5"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($tags as $tag)
                    <tr class="hover:bg-brand-gray/50">
                        <td class="px-5 py-3"><span class="{{ $tag->badge_class }} text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full">{{ $tag->label }}</span></td>
                        <td class="px-5 py-3 font-semibold">{{ $tag->label }}</td>
                        <td class="px-5 py-3 text-gray-500 font-mono text-xs">{{ $tag->key }}</td>
                        <td class="px-5 py-3">{{ $tag->blocks_ordering ? 'Yes' : 'No' }}</td>
                        <td class="px-5 py-3">{{ $tag->products_count }}</td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.tags.edit', $tag) }}" class="text-brand-orange hover:underline text-xs font-semibold">Edit</a>
                            <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" class="inline" onsubmit="return confirm('Delete this tag?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-xs font-semibold ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">No tags yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
