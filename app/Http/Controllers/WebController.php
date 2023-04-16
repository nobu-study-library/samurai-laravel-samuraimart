<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class WebController extends Controller
{
  public function index()
  {
    $categories = Category::all()->sortBy('major_category_name');
    $majorCategoryNames = Category::pluck('major_category_name')->unique();

    return view('web.index', compact('majorCategoryNames', 'categories'));
  }
}
