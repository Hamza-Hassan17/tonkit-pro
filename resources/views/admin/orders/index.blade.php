<x-admin-layout>
    <x-slot name="title">Orders</x-slot>
    <x-slot name="breadcrumb">Orders</x-slot>

    <div class="flex flex-wrap items-center gap-2 mb-5">
        <a href="{{ route('admin.orders.index') }}"
           class="text-xs font-semibold uppercase tracking-wide px-3 py-1.5 rounded-full border {{ $status === '' ? 'bg-brand-dark text-white border-brand-dark' : 'border-gray-300 text-gray-500 hover:border-brand-orange hover:text-brand-orange' }}">
            All
        </a>
        @foreach ($statuses as $s)
            <a href="{{ route('admin.orders.index', ['status' => $s]) }}"
               class="text-xs font-semibold uppercase tracking-wide px-3 py-1.5 rounded-full border {{ $status === $s ? 'bg-brand-dark text-white border-brand-dark' : 'border-gray-300 text-gray-500 hover:border-brand-orange hover:text-brand-orange' }}">
                {{ str_replace('_', ' ', $s) }}
            </a>
        @endforeach
    </div>

    <div class="border border-gray-200 rounded-lg bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-brand-gray text-[11px] uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="text-left px-5 py-2.5">Order</th>
                    <th class="text-left px-5 py-2.5">Customer</th>
                    <th class="text-left px-5 py-2.5">Status</th>
                    <th class="text-right px-5 py-2.5">Total</th>
                    <th class="text-left px-5 py-2.5">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    <tr class="hover:bg-brand-gray/50 cursor-pointer" onclick="window.location='{{ route('admin.orders.show', $order) }}'">
                        <td class="px-5 py-3 font-semibold text-brand-dark">#{{ $order->id }}</td>
                        <td class="px-5 py-3">{{ $order->contactName() }}<br><span class="text-xs text-gray-400">{{ $order->contactEmail() }}</span></td>
                        <td class="px-5 py-3"><span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-gray-100 text-gray-600">{{ str_replace('_', ' ', $order->status) }}</span></td>
                        <td class="px-5 py-3 text-right font-semibold"><x-price :amount="$order->total" /></td>
                        <td class="px-5 py-3 text-gray-500">{{ $order->created_at->format('M j, Y g:ia') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</x-admin-layout>
