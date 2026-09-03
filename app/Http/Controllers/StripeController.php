<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class StripeController extends Controller
{
    /**
     * Stripe redirects here after a successful payment. We verify the session
     * server-side, then create the order from the stashed pending payload.
     */
    public function success(Request $request, CheckoutController $checkout)
    {
        // Order was already placed (Stripe-not-configured path in CheckoutController).
        if ($request->session()->has('order_id')) {
            $order = \App\Models\Order::with('items')->find($request->session()->get('order_id'));

            return view('checkout.success', ['order' => $order]);
        }

        $pending = Session::get('pending_order');
        $sessionId = $request->query('session_id');

        if (! $pending || ! $sessionId) {
            return redirect()->route('cart.index')->with('error', 'We could not find your order. Please try again.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = StripeSession::retrieve($sessionId);

        if (($session->payment_status ?? null) !== 'paid') {
            return redirect()->route('cart.index')->with('error', 'Payment was not completed. Please try again.');
        }

        $order = $checkout->finalizeOrder($pending, [
            'status'                => 'paid',
            'payment_method'        => 'stripe',
            'stripe_session_id'     => $session->id,
            'stripe_payment_intent' => is_string($session->payment_intent ?? null) ? $session->payment_intent : null,
        ]);

        Session::forget(['cart', 'pending_order']);

        return view('checkout.success', ['order' => $order->load('items')]);
    }

    public function cancel()
    {
        Session::forget('pending_order');

        return redirect()->route('checkout.index')->with('error', 'Payment was cancelled — your cart is still saved.');
    }
}
