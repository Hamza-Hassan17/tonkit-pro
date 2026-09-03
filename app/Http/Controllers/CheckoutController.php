<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(CartController $cart)
    {
        $items = $cart->cartWithProductData();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', [
            'items' => $items,
            'total' => $cart->total($items),
        ]);
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->latest()->with('items')->get();

        return view('orders.index', compact('orders'));
    }
}
