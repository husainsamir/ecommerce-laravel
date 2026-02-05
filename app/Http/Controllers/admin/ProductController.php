<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.products.addproduct', compact('categories'));
    }

    public function store(Request $request)
{
    //  Validation
    $validated = $request->validate([
        'name'           => 'required|min:3',
        'category_id'    => 'required|exists:categories,id',
        'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'description'    => 'required|min:10',
        'price'          => 'required|numeric|min:1',
        'stock_quantity' => 'required|integer|min:0',
        'status'         => 'required|in:active,inactive',
    ]);

    //  Image Upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        // result: products/filename.jpg
    }

    //  Save Product
    Product::create([
        'name'           => $validated['name'],
        'category_id'    => $validated['category_id'],
        'image'          => $imagePath,
        'description'    => $validated['description'],
        'price'          => $validated['price'],
        'stock_quantity' => $validated['stock_quantity'],
        'status'         => $validated['status'],
    ]);

    return redirect()
        ->route('product.index')
        ->with('success', 'Product Added Successfully');
}


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 'active')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }


   public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    //  Validation
    $validated = $request->validate([
        'name'           => 'required|min:3',
        'category_id'    => 'required|exists:categories,id',
        'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'description'    => 'required|min:10',
        'price'          => 'required|numeric|min:1',
        'stock_quantity' => 'required|integer|min:0',
        'status'         => 'required|in:active,inactive',
    ]);

    //  Image Update (agar nayi image aaye)
    if ($request->hasFile('image')) {

        // purani image delete
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // nayi image upload
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    //  Update Product
    $product->update($validated);

    return redirect()
        ->route('product.index')
        ->with('success', 'Product Updated Successfully');
}


    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully!');
    }
}
