<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    // Show create category form
    public function create()
    {
        // Get top-level categories (parent_cat_id = NULL)
        $parentCategories = Category::whereNull('parent_cat_id')->get();
        return view('admin.category.create', compact('parentCategories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
            'parent_cat_id' => 'nullable|exists:categories,id', // parent must exist or NULL
            'status' => 'required|in:active,inactive',
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
            'url_slug' => Str::slug($request->category_name),
            'parent_cat_id' => $request->parent_cat_id ?: null, // NULL if top-level
            'status' => $request->status,
        ]);

        return redirect()->route('category.index')->with('success', 'Category Added Successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $parentCategories = Category::whereNull('parent_cat_id')
            ->where('id', '!=', $id)
            ->get();

        return view('admin.category.edit', compact('category', 'parentCategories'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $id,
            'parent_cat_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        Category::where('id', $id)->update([
            'category_name' => $request->category_name,
            'url_slug' => Str::slug($request->category_name),
            'parent_cat_id' => $request->parent_cat_id ?: null, // NULL if top-level
            'status' => $request->status,
        ]);

        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    // Delete category
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category Deleted Successfully');
    }
}
