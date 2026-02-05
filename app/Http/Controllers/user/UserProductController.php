<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class UserProductController extends Controller
{
    // All Products + Search
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Product::where('status', 'active')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $categories = $this->getCategories();

        return view('user.products.index', compact('products', 'categories', 'search'));
    }

    // Product Detail Page
    public function show($id)
    {
        $product = Product::where('status', 'active')->findOrFail($id);

        $categories = $this->getCategories();

        $relatedProducts = Product::where('status', 'active')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('user.products.show', compact('product', 'categories', 'relatedProducts'));
    }

    // Category Wise Products
    public function categoryProducts($id)
    {
        $products = Product::where('category_id', $id)
            ->where('status', 'active')
            ->latest()
            ->get();

        $categories = $this->getCategories();

        return view('user.products.index', compact('products', 'categories'));
    }

    // =========================
    // Helper function to get categories
    // =========================
    private function getCategories()
    {
        return Category::where('status', 'active')
            ->whereNull('parent_cat_id')
            ->get();
    }
}
