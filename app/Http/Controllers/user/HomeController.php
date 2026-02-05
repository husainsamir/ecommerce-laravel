<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
class HomeController extends Controller
{
    public function index()
    {
          $categories = Category::where('status', 'active')
        ->whereNull('parent_cat_id')
        ->get();
        return view('user.layouts.app',compact('categories'));
    }
}
