<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function showPaymentPage(Order $order)
    {
        $categories = Category::where('status', 'active')
            ->whereNull('parent_cat_id')
            ->get();

        return view('user.payment.page', compact('order','categories'));
    }

    // ================= FAKE PAYMENT =================
    public function fakePayment(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        // Mark order as PAID
        $order->update([
            'status' => 'paid',
            'payment_method' => 'test',
            'payment_id' => 'TEST_' . time(),
        ]);

        return redirect()
            ->route('user.order.success', $order->id)
            ->with('success', 'Payment Successful (Test Mode)');
    }
}
