<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const STATUSES = ['pending', 'pending_payment', 'paid', 'processing', 'shipped', 'completed', 'cancelled'];

    public function index(Request $request)
    {
        $status = $request->input('status', '');

        $orders = Order::with('items')
            ->when($status !== '', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', ['orders' => $orders, 'status' => $status, 'statuses' => self::STATUSES]);
    }

    public function show(Order $order)
    {
        $order->load('items');

        return view('admin.orders.show', ['order' => $order, 'statuses' => self::STATUSES]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
        ]);

        $order->update($data);

        return back()->with('success', 'Order status updated.');
    }
}
