<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Product;

class WebController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    $majorCategories = MajorCategory::all();
    $recentlyProducts = Product::orderBy('created_at', 'desc')
      ->take(4)
      ->get();

    return view(
      'web.index',
      compact('majorCategories', 'categories', 'recentlyProducts')
    );
  }
}
