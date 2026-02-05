<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;   //
use App\Models\Category;

class CheckoutController extends Controller
{
    // ======================
    // Checkout Page
    // ======================
    public function index()
    {
        $categories = Category::where('status','active')
            ->whereNull('parent_cat_id')
            ->get();

        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('success','Your cart is empty');
        }

        return view('user.checkout.index', compact('cartItems','categories'));
    }

    // ======================
    // Place Order
    // ======================
    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_full_address' => 'required|min:10',
            'shipping_city'         => 'required|string|max:100',
            'shipping_state'        => 'required|string|max:100',
            'shipping_zip_code'     => 'required|string|max:20',

            'billing_full_address'  => 'required|min:10',
            'billing_city'          => 'required|string|max:100',
            'billing_state'         => 'required|string|max:100',
            'billing_zip_code'      => 'required|string|max:20',
        ]);

        DB::beginTransaction();

        try {
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error','Your cart is empty!');
            }

            // Calculate total
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }

            // Create Order
            $order = Order::create([
                'user_id'       => auth()->id(),
                'total_amount' => $total,
                'status'       => 'pending',
            ]);

            // Order Items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id' => $item->product_id,
                    'price'      => $item->product->price,
                    'quantity'   => $item->quantity,
                ]);
            }

            // Shipping Address
            OrderAddress::create([
                'order_id'     => $order->id,
                'user_id'      => auth()->id(),
                'type'         => 'shipping',
                'full_address' => $request->shipping_full_address,
                'city'         => $request->shipping_city,
                'state'        => $request->shipping_state,
                'zip_code'     => $request->shipping_zip_code,
            ]);

            // Billing Address
            OrderAddress::create([
                'order_id'     => $order->id,
                'user_id'      => auth()->id(),
                'type'         => 'billing',
                'full_address' => $request->billing_full_address,
                'city'         => $request->billing_city,
                'state'        => $request->billing_state,
                'zip_code'     => $request->billing_zip_code,
            ]);

            // Clear Cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('orders.success')
                ->with('success','Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error','Something went wrong');
        }
    }

    // ======================
    // Success Page
    // ======================
    public function success()
{
    $categories = Category::where('status', 'active')
        ->whereNull('parent_cat_id')
        ->get();

    //  Last order of logged-in user
    $order = Order::with(['items.product', 'shippingAddress', 'billingAddress'])
        ->where('user_id', auth()->id())
        ->latest()
        ->first();

    if (!$order) {
        return redirect()->route('user.home')
        ->with('fail','This Time Not Order');
    }

    return view('user.checkout.success', compact('categories', 'order'));
}

}
