<x-admin-layout>
    <x-slot name="title">Order #{{ $order->id }}</x-slot>
    <x-slot name="breadcrumb"><a href="{{ route('admin.orders.index') }}" class="hover:text-brand-orange">Orders</a> / #{{ $order->id }}</x-slot>

    <div class="grid lg:grid-cols-[1fr_320px] gap-8">
        <div class="space-y-6">
            <div class="border border-gray-200 rounded-lg bg-white p-6">
                <h2 class="font-extrabold mb-4">Items</h2>
                @foreach ($order->items as $item)
                    <div class="flex justify-between py-2 border-b border-gray-100 last:border-b-0 text-sm">
                        <span>
                            {{ $item->product_name }}
                            @if ($item->color_name)<span class="text-gray-400">({{ $item->color_name }})</span>@endif
                            @if ($item->decoration_label)<span class="text-gray-400">+ {{ $item->decoration_label }}</span>@endif
                            @if ($item->decoration_location_label)<span class="text-gray-400">({{ $item->decoration_location_label }})</span>@endif
                            <span class="text-gray-400">&times; {{ $item->qty }}</span>
                        </span>
                        <span class="font-semibold"><x-price :amount="$item->price * $item->qty" /></span>
                    </div>
                @endforeach
                <div class="pt-3 mt-2 border-t border-gray-200 space-y-1.5 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Caps &amp; decoration</span><span><x-price :amount="$order->items_subtotal" /></span></div>
                    @if ($order->setup_fees_total > 0)
                        <div class="flex justify-between"><span class="text-gray-500">Setup fees</span><span><x-price :amount="$order->setup_fees_total" /></span></div>
                    @endif
                    <div class="flex justify-between"><span class="text-gray-500">Shipping</span><span>@if ($order->shipping_total > 0)<x-price :amount="$order->shipping_total" />@else Free @endif</span></div>
                    @if ($order->discount_total > 0)
                        <div class="flex justify-between text-green-600 font-semibold"><span>Discount ({{ $order->discount_code }})</span><span>&minus;<x-price :amount="$order->discount_total" /></span></div>
                    @endif
                </div>
                <div class="flex justify-between pt-3 mt-2 border-t border-gray-200 font-bold text-lg">
                    <span>Total</span><span class="text-brand-orange"><x-price :amount="$order->total" /></span>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg bg-white p-6">
                <h2 class="font-extrabold mb-4">Customer &amp; Shipping</h2>
                <dl class="text-sm space-y-2">
                    <div class="flex justify-between"><dt class="text-gray-500">Name</dt><dd class="font-semibold">{{ $order->contactName() }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Email</dt><dd>{{ $order->contactEmail() }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Phone</dt><dd>{{ $order->customer_phone }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Address</dt><dd class="text-right">{{ $order->shipping_address }}</dd></div>
                </dl>
            </div>
        </div>

        <div class="space-y-4">
            <div class="border border-gray-200 rounded-lg bg-white p-6">
                <h2 class="font-extrabold mb-4">Status</h2>
                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="space-y-3">
                    @csrf @method('PATCH')
                    <x-select name="status" onchange="this.form.submit()">
                        @foreach ($statuses as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ str_replace('_', ' ', $s) }}</option>
                        @endforeach
                    </x-select>
                </form>
                <dl class="text-xs text-gray-400 mt-4 space-y-1">
                    <div class="flex justify-between"><dt>Placed</dt><dd>{{ $order->created_at->format('M j, Y g:ia') }}</dd></div>
                    <div class="flex justify-between"><dt>Payment</dt><dd>{{ $order->payment_method }}</dd></div>
                </dl>
            </div>
        </div>
    </div>
</x-admin-layout>
