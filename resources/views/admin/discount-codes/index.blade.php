<x-admin-layout>
    <x-slot name="title">Discount Codes</x-slot>
    <x-slot name="breadcrumb">Discount Codes</x-slot>

    <div class="flex justify-end mb-5">
        <a href="{{ route('admin.discount-codes.create') }}" class="btn-orange !py-2.5">+ New Code</a>
    </div>

    <div class="border border-gray-200 rounded-lg bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-brand-gray text-[11px] uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="text-left px-5 py-2.5">Code</th>
                    <th class="text-left px-5 py-2.5">% Off</th>
                    <th class="text-left px-5 py-2.5">Status</th>
                    <th class="text-left px-5 py-2.5">Created</th>
                    <th class="px-5 py-2.5"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($codes as $code)
                    <tr class="hover:bg-brand-gray/50">
                        <td class="px-5 py-3 font-mono font-semibold">{{ $code->code }}</td>
                        <td class="px-5 py-3">{{ rtrim(rtrim(number_format($code->percent_off, 2), '0'), '.') }}%</td>
                        <td class="px-5 py-3">
                            @if ($code->active)
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-green-100 text-green-700">Active</span>
                            @else
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-gray-100 text-gray-500">Inactive</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $code->created_at->format('M j, Y') }}</td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.discount-codes.edit', $code) }}" class="text-brand-orange hover:underline text-xs font-semibold">Edit</a>
                            <form method="POST" action="{{ route('admin.discount-codes.destroy', $code) }}" class="inline" onsubmit="return confirm('Delete this discount code?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-xs font-semibold ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">No discount codes yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $codes->links() }}</div>
</x-admin-layout>
