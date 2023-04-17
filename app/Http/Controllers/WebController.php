<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;

class WebController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    $majorCategories = MajorCategory::all();

    return view('web.index', compact('majorCategories', 'categories'));
  }
}
