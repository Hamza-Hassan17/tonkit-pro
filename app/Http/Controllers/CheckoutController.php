<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(CartController $cart)
    {
        $items = $cart->cartWithProductData();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', [
            'items'  => $items,
            'total'  => $cart->total($items),
            'user'   => Auth::user(),
        ]);
    }

    public function store(Request $request, CartController $cart)
    {
        $items = $cart->cartWithProductData();
        $total = $cart->total($items);

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'customer_name'    => ['required', 'string', 'max:120'],
            'customer_email'   => ['required', 'email', 'max:160'],
            'customer_phone'   => ['required', 'string', 'max:40'],
            'address_line'     => ['required', 'string', 'max:200'],
            'city'             => ['required', 'string', 'max:80'],
            'postal_code'      => ['nullable', 'string', 'max:20'],
            'country'          => ['required', 'string', 'max:80'],
        ]);

        $shippingAddress = trim(implode(', ', array_filter([
            $data['address_line'],
            $data['city'],
            $data['postal_code'] ?? null,
            $data['country'],
        ])));

        $pending = [
            'user_id'          => Auth::id(),
            'customer_name'    => $data['customer_name'],
            'customer_email'   => $data['customer_email'],
            'customer_phone'   => $data['customer_phone'],
            'shipping_address' => $shippingAddress,
            'items'            => $items,
            'total'            => $total,
        ];

        Session::put('pending_order', $pending);

        // If Stripe isn't configured yet, place the order as unpaid so the
        // storefront still works. Payment is arranged manually afterwards.
        if (! config('services.stripe.secret')) {
            Log::warning('Stripe secret not set — placing order as unpaid.');
            $order = $this->finalizeOrder($pending, [
                'status'         => 'pending_payment',
                'payment_method' => 'unpaid',
            ]);
            Session::forget(['cart', 'pending_order']);

            return redirect()->route('checkout.success')->with('order_id', $order->id);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'mode'                 => 'payment',
            'customer_email'       => $data['customer_email'],
            'client_reference_id'  => Auth::id(),
            'line_items'           => array_map(fn ($i) => [
                'quantity'   => $i['qty'],
                'price_data' => [
                    'currency'     => config('services.stripe.currency', 'pkr'),
                    'unit_amount'  => (int) round($i['price'] * 100),
                    'product_data' => [
                        'name' => $i['name'].($i['color_name'] ? " — {$i['color_name']}" : ''),
                    ],
                ],
            ], $items),
            'success_url'          => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => route('checkout.cancel'),
        ]);

        Session::put('pending_order', array_merge($pending, ['stripe_session_id' => $session->id]));

        return redirect($session->url);
    }

    /**
     * Create the Order + OrderItem rows from a pending-order payload.
     */
    public function finalizeOrder(array $pending, array $overrides = []): Order
    {
        $order = Order::create(array_merge([
            'user_id'          => $pending['user_id'],
            'customer_name'    => $pending['customer_name'],
            'customer_email'   => $pending['customer_email'],
            'customer_phone'   => $pending['customer_phone'],
            'shipping_address' => $pending['shipping_address'],
            'total'            => $pending['total'],
            'status'           => 'paid',
            'payment_method'   => 'stripe',
        ], $overrides));

        foreach ($pending['items'] as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_slug' => $item['slug'],
                'product_name' => $item['name'],
                'color'        => $item['color'] ?? null,
                'color_name'   => $item['color_name'] ?? null,
                'price'        => $item['price'],
                'qty'          => $item['qty'],
            ]);
        }

        return $order;
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->latest()->with('items')->get();

        return view('orders.index', compact('orders'));
    }
}
