<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderPaymentController extends Controller
{
    public function showPaymentPage(Order $order)
    {
        $categories = Category::where('status', 'active')
            ->whereNull('parent_cat_id')
            ->get();

        return view('user.payment.page', compact('order','categories'));
    }

    // ===== STRIPE CHECKOUT (NO JS) =====
    public function stripeCheckout(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                    'unit_amount' => (int) ($order->total_amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',

            // ✅ success ke baad controller me status update hoga
            'success_url' => route('user.order.success', $order->id),
            'cancel_url' => route('payment.page', $order->id),
        ]);

        return redirect($session->url);
    }
}
