<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    /**
     * Kick off the PayPal Express Checkout flow. Redirects the browser to
     * PayPal to approve payment; PayPal then redirects back to success()/cancel().
     */
    public function create(CartController $cart)
    {
        $items = $cart->cartWithProductData();
        $total = $cart->total($items);

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $provider = new ExpressCheckout();

        $cartData = [
            'items' => array_map(fn ($i) => [
                'name'  => $i['name'],
                'price' => $i['price'],
                'qty'   => $i['qty'],
            ], $items),
            'invoice_id'          => uniqid('TK-'),
            'invoice_description' => 'TonKit.Pro order',
            'return_url'          => route('checkout.success'),
            'cancel_url'          => route('checkout.cancel'),
            'total'               => $total,
        ];

        // Stash the cart + user id so success() can rebuild the order after
        // PayPal redirects back (the request at that point isn't authenticated
        // by Laravel's guard the same way, so we don't rely on Auth::check()).
        Session::put('pending_order', [
            'user_id' => Auth::id(),
            'items'   => $items,
            'total'   => $total,
        ]);

        $response = $provider->setExpressCheckout($cartData);

        return redirect($response['paypal_link']);
    }

    public function success(\Illuminate\Http\Request $request)
    {
        $pending = Session::get('pending_order');

        if (! $pending) {
            return redirect()->route('cart.index')->with('error', 'We could not find your order. Please try again.');
        }

        $provider = new ExpressCheckout();

        $response = $provider->getExpressCheckoutDetails($request->token);

        $payment = $provider->doExpressCheckoutPayment([
            'total'      => $pending['total'],
            'invoice_id' => uniqid('TK-'),
            'items'      => array_map(fn ($i) => [
                'name'  => $i['name'],
                'price' => $i['price'],
                'qty'   => $i['qty'],
            ], $pending['items']),
        ], $request->token, $request->PayerID);

        if (($payment['ACKCODE'] ?? '') !== 'Success') {
            return redirect()->route('cart.index')->with('error', 'Payment was not completed. Please try again.');
        }

        $order = Order::create([
            'user_id'         => $pending['user_id'],
            'total'           => $pending['total'],
            'status'          => 'paid',
            'paypal_txn_id'   => $payment['PAYMENTINFO_0_TRANSACTIONID'] ?? null,
        ]);

        foreach ($pending['items'] as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_slug' => $item['slug'],
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'qty'          => $item['qty'],
            ]);
        }

        Session::forget(['cart', 'pending_order']);

        return view('checkout.success', compact('order'));
    }

    public function cancel()
    {
        Session::forget('pending_order');

        return redirect()->route('cart.index')->with('error', 'Payment was cancelled.');
    }
}
