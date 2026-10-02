<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach ([
            ['label' => 'Products', 'value' => $stats['products'], 'href' => route('admin.products.index')],
            ['label' => 'Open Orders', 'value' => $stats['open_orders'], 'href' => route('admin.orders.index')],
            ['label' => 'Active Discount Codes', 'value' => $stats['active_codes'], 'href' => route('admin.discount-codes.index')],
            ['label' => 'Back Order', 'value' => $stats['back_order'], 'href' => route('admin.products.index', ['tag' => 'back-order'])],
        ] as $tile)
            <a href="{{ $tile['href'] }}" class="block border border-gray-200 rounded-lg p-5 bg-white hover:border-brand-orange transition-colors">
                <div class="text-3xl font-extrabold text-brand-dark">{{ $tile['value'] }}</div>
                <div class="text-xs uppercase tracking-wide text-gray-500 mt-1">{{ $tile['label'] }}</div>
            </a>
        @endforeach
    </div>

    <div class="border border-gray-200 rounded-lg bg-white overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-extrabold">Recent Orders</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-brand-orange hover:underline">View all</a>
        </div>
        @if ($recentOrders->isEmpty())
            <p class="p-5 text-sm text-gray-500">No orders yet.</p>
        @else
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
                    @foreach ($recentOrders as $order)
                        <tr class="hover:bg-brand-gray/50">
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-brand-dark hover:text-brand-orange">#{{ $order->id }}</a>
                            </td>
                            <td class="px-5 py-3">{{ $order->contactName() }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-gray-100 text-gray-600">{{ $order->status }}</span>
                            </td>
                            <td class="px-5 py-3 text-right font-semibold"><x-price :amount="$order->total" /></td>
                            <td class="px-5 py-3 text-gray-500">{{ $order->created_at->format('M j, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
