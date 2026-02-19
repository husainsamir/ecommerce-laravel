<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    // Show all orders to admin
    public function index()
    {
        // Get all orders, latest first
        $orders = Order::orderBy('created_at', 'desc')->get();

        // Return view with orders
        return view('admin.orders.index', compact('orders'));
    }

    // Optional: Show single order details
    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
