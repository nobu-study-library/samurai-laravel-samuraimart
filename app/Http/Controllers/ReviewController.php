<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'content' => 'required',
    ]);

    $review = new Review();
    $review->content = $request->input('content');
    $review->product_id = $request->input('product_id');
    $review->user_id = Auth::user()->id;
    $review->save();

    return back();
  }
}
