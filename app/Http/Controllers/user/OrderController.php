<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
class OrderController extends Controller
{
    public function success(Order $order)
    {
        //  Stripe checkout ke baad order PAID mark karo
        if ($order->status !== 'paid') {
            $order->update([
                'status' => 'paid',
                'payment_method' => 'stripe',
                'payment_id' => 'STRIPE_TEST_' . time(),
            ]);
        }

        // Relations load (safe)
        $order->load([
            'items.product',
            'shippingAddress',
            'billingAddress'
        ]);

          $categories = Category::where('status', 'active')
            ->whereNull('parent_cat_id')
            ->get();

        return view('user.order.success', compact('order','categories'));
    }
}
