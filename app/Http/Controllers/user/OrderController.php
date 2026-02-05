<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;

class OrderController extends Controller
{
    /**
     * Order Success Page
     */
    public function success(Order $order)
    {
        // Categories (header / sidebar ke liye)
        $categories = Category::where('status', 'active')
            ->whereNull('parent_cat_id')
            ->get();

        // Order ke saare relations load kar lo
        $order->load([
            'items.product',
            'shippingAddress',
            'billingAddress'
        ]);

        return view('user.order.success', compact('order', 'categories'));
    }
}
