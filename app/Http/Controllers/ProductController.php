<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\MajorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->category !== null) {
      $productList = Product::where('category_id', $request->category)
        ->sortable()
        ->paginate(15);
      $totalCount = Product::where('category_id', $request->category)->count();
      $category = Category::find($request->category);
      $majorCategory = MajorCategory::find($category->major_category_id);
    } else {
      $productList = Product::sortable()->paginate(15);
      $totalCount = '';
      $category = null;
      $majorCategory = null;
    }
    $categories = Category::all();
    $majorCategories = MajorCategory::all();

    return view(
      'products.index',
      compact(
        'productList',
        'majorCategory',
        'category',
        'categories',
        'majorCategories',
        'totalCount'
      )
    );
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categoryList = Category::all();
    return view('products.create', compact('categoryList'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $product = new Product();
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->category_id = $request->input('category_id');
    $product->save();

    return to_route('products.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    $reviews = $product->reviews()->get();

    return view('products.show', compact('product', 'reviews'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Product $product)
  {
    $categoryList = Category::all();
    return view('products.edit', compact('product', 'categoryList'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->category_id = $request->input('categoryId');
    $product->save();

    return to_route('products.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    $product->delete();
    return to_route('products.index');
  }

  public function favorite(Product $product)
  {
    /* intelephense-disable */
    Auth::user()->togglefavorite($product);
    /* intelephense-enable */

    return back();
  }
}
