<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    const SESSION_KEY = 'cart';

    public function index()
    {
        $cart = $this->cartWithProductData();

        return view('cart.index', ['items' => $cart, 'total' => $this->total($cart)]);
    }

    public function add(Request $request, string $slug)
    {
        $product = ProductController::find($slug);
        abort_if(! $product, Response::HTTP_NOT_FOUND);

        $qty = max(1, (int) $request->input('qty', 1));

        $cart = Session::get(self::SESSION_KEY, []);
        $cart[$slug] = ($cart[$slug] ?? 0) + $qty;
        Session::put(self::SESSION_KEY, $cart);

        return back()->with('success', "{$product['name']} added to cart.");
    }

    public function update(Request $request, string $slug)
    {
        $qty = max(1, (int) $request->input('qty', 1));

        $cart = Session::get(self::SESSION_KEY, []);
        if (array_key_exists($slug, $cart)) {
            $cart[$slug] = $qty;
            Session::put(self::SESSION_KEY, $cart);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove(string $slug)
    {
        $cart = Session::get(self::SESSION_KEY, []);
        unset($cart[$slug]);
        Session::put(self::SESSION_KEY, $cart);

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Merge the session's slug=>qty pairs with live product data (price, name, image).
     * Used by the cart page and by checkout.
     */
    public function cartWithProductData(): array
    {
        $cart = Session::get(self::SESSION_KEY, []);
        $items = [];

        foreach ($cart as $slug => $qty) {
            $product = ProductController::find($slug);
            if (! $product) {
                continue; // product was removed from catalog since being added
            }
            $items[] = array_merge($product, ['qty' => $qty]);
        }

        return $items;
    }

    public function total(array $items): float
    {
        return round(array_sum(array_map(fn ($i) => $i['price'] * $i['qty'], $items)), 2);
    }
}
