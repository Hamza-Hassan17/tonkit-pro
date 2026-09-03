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

        $color = ProductController::color($product, $request->input('color'));
        $qty   = max(1, (int) $request->input('qty', 1));
        $key   = $this->key($slug, $color['slug']);

        $cart = Session::get(self::SESSION_KEY, []);
        $cart[$key] = [
            'slug'  => $slug,
            'color' => $color['slug'],
            'qty'   => ($cart[$key]['qty'] ?? 0) + $qty,
        ];
        Session::put(self::SESSION_KEY, $cart);

        return back()->with('success', "{$product['name']} ({$color['name']}) added to your cart.");
    }

    public function update(Request $request, string $slug)
    {
        $key = $this->key($slug, $request->input('color'));
        $qty = max(1, (int) $request->input('qty', 1));

        $cart = Session::get(self::SESSION_KEY, []);
        if (array_key_exists($key, $cart)) {
            $cart[$key]['qty'] = $qty;
            Session::put(self::SESSION_KEY, $cart);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request, string $slug)
    {
        $key = $this->key($slug, $request->input('color'));

        $cart = Session::get(self::SESSION_KEY, []);
        unset($cart[$key]);
        Session::put(self::SESSION_KEY, $cart);

        return back()->with('success', 'Item removed from your cart.');
    }

    /**
     * Merge the session's cart lines with live product data
     * (price, name, and the image for the chosen color).
     */
    public function cartWithProductData(): array
    {
        $cart  = Session::get(self::SESSION_KEY, []);
        $items = [];

        foreach ($cart as $line) {
            $product = ProductController::find($line['slug']);
            if (! $product) {
                continue; // product left the catalog since being added
            }

            $color = ProductController::color($product, $line['color'] ?? null);

            $items[] = array_merge($product, [
                'qty'        => $line['qty'],
                'color'      => $color['slug'],
                'color_name' => $color['name'],
                'color_hex'  => $color['hex'] ?? null,
                'image'      => $color['image'] ?? $product['image'],
                'cart_key'   => $this->key($line['slug'], $color['slug']),
            ]);
        }

        return $items;
    }

    public function total(array $items): float
    {
        return round(array_sum(array_map(fn ($i) => $i['price'] * $i['qty'], $items)), 2);
    }

    private function key(string $slug, ?string $colorSlug): string
    {
        return $slug.'::'.($colorSlug ?: 'default');
    }
}
