<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $productList = Product::all();

    return view('products.index', compact('productList'));
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
    return view('products.show', compact('product'));
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
}
