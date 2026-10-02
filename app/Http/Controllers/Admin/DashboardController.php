<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'     => Product::count(),
            'open_orders'  => Order::whereIn('status', ['pending', 'pending_payment', 'paid', 'processing'])->count(),
            'active_codes' => DiscountCode::where('active', true)->count(),
            'back_order'   => Product::whereHas('tags', fn ($q) => $q->where('key', 'back-order'))->count(),
        ];

        $recentOrders = Order::latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
