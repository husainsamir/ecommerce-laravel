<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function index(Product $product)
    {
        $images = $product->images()->latest()->get();

        return view('admin.images.index', compact('product', 'images'));
    }

   public function create(Product $product)
{
    $products = Product::orderBy('name')->get();

    return view('admin.images.create', compact('product', 'products'));
}


    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_primary' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('products', 'public');

        if ($request->boolean('is_primary')) {
            ProductImage::where('product_id', $product->id)
                ->update(['is_primary' => false]);
        }

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $path,
            'is_primary' => $request->boolean('is_primary'),
        ]);

        return redirect()
            ->route('product.images.index', $product->id)
            ->with('success', 'Image added successfully!');
    }

    public function edit(ProductImage $image)
    {
        return view('admin.images.edit', compact('image'));
    }

    public function update(Request $request, ProductImage $image)
{
    $request->validate([
        'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_primary' => 'nullable',
    ]);

    $data = [];

    // Image replace logic
    if ($request->hasFile('image')) {
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $data['image_path'] = $request->file('image')->store('products', 'public');
    }

    // Checkbox logic → force 0/1
    $isPrimary = $request->has('is_primary') ? 1 : 0;

    if ($isPrimary === 1) {
        // Is product ki baaki images ko non-primary karo
        ProductImage::where('product_id', $image->product_id)
            ->update(['is_primary' => 1]);

        $data['is_primary'] = 1;
    } else {
        $data['is_primary'] = 0;
    }

    $image->update($data);

    return redirect()
        ->route('product.images.index', $image->product_id)
        ->with('success', 'Image updated successfully!');
}


    public function destroy(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}
