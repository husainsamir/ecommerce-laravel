<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class CartController extends Controller
{
    // ================= CART PAGE =================
    public function index()
    {
        $categories = Category::where('status', 'active')
            ->whereNull('parent_cat_id')
            ->get();

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('user.cart.index', compact('cartItems', 'categories'));
    }

    // ================= ADD TO CART =================
    public function add(Request $request, $id)
    {
        // LOGIN CHECK (NO REDIRECT TO LOGIN PAGE)
        if (!Auth::check()) {
            return back()->with('error', 'Please login first to add product to cart.');
        }

        $product = Product::findOrFail($id);
        $userId  = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully.');
    }

    // ================= REMOVE FROM CART =================
    public function remove($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->delete();

        return back()->with('success', 'Product removed from cart.');
    }

    // ================= INCREASE =================
    public function increase($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        }

        return back();
    }

    // ================= DECREASE =================
    public function decrease($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return back();
    }
}
