<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Support\Pricing;
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
            'items'     => $items,
            'breakdown' => Pricing::breakdown($items, Session::get(CartController::DISCOUNT_SESSION_KEY), old('province')),
            'user'      => Auth::user(),
            'provinces' => config('tax.provinces'),
        ]);
    }

    public function store(Request $request, CartController $cart)
    {
        $items = $cart->cartWithProductData();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $hasPrint = collect(Pricing::breakdown($items)['lines'])->contains(fn ($l) => ($l['decoration'] ?? 'none') === 'print');

        $data = $request->validate([
            'customer_name'  => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:160'],
            'customer_phone' => ['required', 'string', 'max:40'],
            'address_line'   => ['required', 'string', 'max:200'],
            'city'           => ['required', 'string', 'max:80'],
            'province'       => ['required', 'in:'.implode(',', config('tax.provinces'))],
            'postal_code'    => ['nullable', 'string', 'max:20'],
            'country'        => ['required', 'in:Canada'],
            'dtf_ack'        => [$hasPrint ? 'accepted' : 'nullable'],
        ], [
            'province.in'      => 'Please select a valid Canadian province or territory.',
            'country.in'       => 'We currently ship within Canada only.',
            'dtf_ack.accepted' => 'Please confirm you understand the DTF print notice before continuing.',
        ]);

        $breakdown = Pricing::breakdown($items, Session::get(CartController::DISCOUNT_SESSION_KEY), $data['province']);

        $shippingAddress = trim(implode(', ', array_filter([
            $data['address_line'], $data['city'], $data['province'], $data['postal_code'] ?? null, $data['country'],
        ])));

        $pending = [
            'user_id'          => Auth::id(),
            'customer_name'    => $data['customer_name'],
            'customer_email'   => $data['customer_email'],
            'customer_phone'   => $data['customer_phone'],
            'shipping_address' => $shippingAddress,
            'province'         => $data['province'],
            'breakdown'        => $breakdown,
        ];

        Session::put('pending_order', $pending);

        if (! config('services.stripe.secret')) {
            Log::warning('Stripe secret not set — placing order as unpaid.');
            $order = $this->finalizeOrder($pending, [
                'status'         => 'pending_payment',
                'payment_method' => 'unpaid',
            ]);
            Session::forget(['cart', 'pending_order', CartController::DISCOUNT_SESSION_KEY]);

            return redirect()->route('checkout.success')->with('order_id', $order->id);
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $currency = config('services.stripe.currency', 'cad');

        $lineItems = [];
        foreach ($breakdown['lines'] as $line) {
            $name = $line['name']
                . ($line['color_name'] ? " — {$line['color_name']}" : '')
                . ($line['decoration'] !== 'none' ? " + {$line['decoration_label']}" : '');
            $lineItems[] = [
                'quantity'   => $line['qty'],
                'price_data' => [
                    'currency'     => $currency,
                    'unit_amount'  => (int) round($line['unit_price'] * 100),
                    'product_data' => ['name' => $name],
                ],
            ];
        }
        foreach ($breakdown['setup_fees'] as $fee) {
            $lineItems[] = [
                'quantity'   => 1,
                'price_data' => [
                    'currency'     => $currency,
                    'unit_amount'  => (int) round($fee['amount'] * 100),
                    'product_data' => ['name' => $fee['label'].' (one-time)'],
                ],
            ];
        }
        if ($breakdown['shipping'] > 0) {
            $lineItems[] = [
                'quantity'   => 1,
                'price_data' => [
                    'currency'     => $currency,
                    'unit_amount'  => (int) round($breakdown['shipping'] * 100),
                    'product_data' => ['name' => 'Shipping'],
                ],
            ];
        }
        if ($breakdown['gst_total'] > 0) {
            $lineItems[] = [
                'quantity'   => 1,
                'price_data' => [
                    'currency'     => $currency,
                    'unit_amount'  => (int) round($breakdown['gst_total'] * 100),
                    'product_data' => ['name' => 'GST (5%)'],
                ],
            ];
        }
        if ($breakdown['qst_total'] > 0) {
            $lineItems[] = [
                'quantity'   => 1,
                'price_data' => [
                    'currency'     => $currency,
                    'unit_amount'  => (int) round($breakdown['qst_total'] * 100),
                    'product_data' => ['name' => 'QST (9.975%)'],
                ],
            ];
        }

        $sessionParams = [
            'mode'                => 'payment',
            'customer_email'      => $data['customer_email'],
            'client_reference_id' => Auth::id(),
            'line_items'          => $lineItems,
            'success_url'         => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'          => route('checkout.cancel'),
        ];

        // Discount is a flat CAD amount (already computed against the items
        // subtotal only -- see Pricing::breakdown), applied as a one-time
        // Stripe coupon rather than a percent-off coupon, so it doesn't also
        // discount setup fees or shipping, which aren't line items Stripe
        // can selectively exclude from a percentage coupon.
        if ($breakdown['discount_total'] > 0) {
            $coupon = \Stripe\Coupon::create([
                'amount_off' => (int) round($breakdown['discount_total'] * 100),
                'currency'   => $currency,
                'duration'   => 'once',
                'name'       => "Discount ({$breakdown['discount_code']})",
            ]);
            $sessionParams['discounts'] = [['coupon' => $coupon->id]];
        }

        $session = StripeSession::create($sessionParams);

        Session::put('pending_order', array_merge($pending, ['stripe_session_id' => $session->id]));

        return redirect($session->url);
    }

    /**
     * Create Order + OrderItem rows from a pending-order payload.
     */
    public function finalizeOrder(array $pending, array $overrides = []): Order
    {
        $b = $pending['breakdown'];

        $order = Order::create(array_merge([
            'user_id'          => $pending['user_id'],
            'customer_name'    => $pending['customer_name'],
            'customer_email'   => $pending['customer_email'],
            'customer_phone'   => $pending['customer_phone'],
            'shipping_address' => $pending['shipping_address'],
            'items_subtotal'   => $b['items_subtotal'],
            'setup_fees_total' => $b['setup_total'],
            'shipping_total'   => $b['shipping'],
            'discount_code'    => $b['discount_code'] ?? null,
            'discount_total'   => $b['discount_total'] ?? 0,
            'province'         => $pending['province'] ?? null,
            'gst_total'        => $b['gst_total'] ?? 0,
            'qst_total'        => $b['qst_total'] ?? 0,
            'pricing_breakdown'=> $b,
            'total'            => $b['total'],
            'status'           => 'paid',
            'payment_method'   => 'stripe',
        ], $overrides));

        foreach ($b['lines'] as $line) {
            OrderItem::create([
                'order_id'         => $order->id,
                'product_slug'     => $line['slug'],
                'product_name'     => $line['name'],
                'color'            => $line['color'] ?? null,
                'color_name'       => $line['color_name'] ?? null,
                'decoration'                 => $line['decoration'] ?? 'none',
                'decoration_label'           => $line['decoration'] !== 'none' ? $line['decoration_label'] : null,
                'decoration_location'        => $line['decoration_location'] ?? null,
                'decoration_location_label'  => $line['decoration_location_label'] ?? null,
                'unit_price'       => $line['unit_price'],
                'price'            => $line['unit_price'],
                'qty'              => $line['qty'],
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
