<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;
class ProductVariantController extends Controller
{
    // Product Variants List
    public function index()
    {
        $variants = ProductVariant::with('product')->latest()->get();
      

        return view('admin.product_variants.index', compact('variants'));
    }

  public function create()
{
    $products = Product::where('status', 'active')->get();
    return view('admin.product_variants.create', compact('products'));
}

}
