<?php

namespace App\Http\Controllers;

use App\Support\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    const SESSION_KEY = 'cart';

    public function index()
    {
        $items = $this->cartWithProductData();

        return view('cart.index', [
            'items'     => $items,
            'breakdown' => Pricing::breakdown($items),
        ]);
    }

    public function add(Request $request, string $slug)
    {
        $product = ProductController::find($slug);
        abort_if(! $product, Response::HTTP_NOT_FOUND);

        $color = ProductController::color($product, $request->input('color'));
        $dec   = array_key_exists($request->input('decoration'), config('pricing.decoration'))
                    ? $request->input('decoration') : 'none';
        $qty   = max(Pricing::moq(), (int) $request->input('qty', Pricing::moq()));
        $key   = $this->key($slug, $color['slug'], $dec);

        $cart = Session::get(self::SESSION_KEY, []);
        $cart[$key] = [
            'slug'       => $slug,
            'color'      => $color['slug'],
            'decoration' => $dec,
            'qty'        => ($cart[$key]['qty'] ?? 0) + $qty,
        ];
        Session::put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')
            ->with('success', "{$product['name']} ({$color['name']}) × {$qty} added to your cart.");
    }

    public function update(Request $request, string $slug)
    {
        $key = $this->key($slug, $request->input('color'), $request->input('decoration'));
        $qty = max(Pricing::moq(), (int) $request->input('qty', Pricing::moq()));

        $cart = Session::get(self::SESSION_KEY, []);
        if (array_key_exists($key, $cart)) {
            $cart[$key]['qty'] = $qty;
            Session::put(self::SESSION_KEY, $cart);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request, string $slug)
    {
        $key = $this->key($slug, $request->input('color'), $request->input('decoration'));

        $cart = Session::get(self::SESSION_KEY, []);
        unset($cart[$key]);
        Session::put(self::SESSION_KEY, $cart);

        return back()->with('success', 'Item removed from your cart.');
    }

    /**
     * Merge session cart lines with live product data + the image for the
     * chosen colour. Prices are computed later by App\Support\Pricing.
     */
    public function cartWithProductData(): array
    {
        $cart  = Session::get(self::SESSION_KEY, []);
        $items = [];

        foreach ($cart as $line) {
            $product = ProductController::find($line['slug']);
            if (! $product) {
                continue;
            }

            $color = ProductController::color($product, $line['color'] ?? null);
            $dec   = $line['decoration'] ?? 'none';

            $items[] = array_merge($product, [
                'qty'              => (int) $line['qty'],
                'color'            => $color['slug'],
                'color_name'       => $color['name'],
                'color_hex'        => $color['hex'] ?? null,
                'image'            => $color['image'] ?? $product['image'],
                'decoration'       => $dec,
                'decoration_label' => Pricing::decoration($dec)['label'],
                'cart_key'         => $this->key($line['slug'], $color['slug'], $dec),
            ]);
        }

        return $items;
    }

    private function key(string $slug, ?string $colorSlug, ?string $decoration): string
    {
        return $slug.'::'.($colorSlug ?: 'default').'::'.($decoration ?: 'none');
    }
}
