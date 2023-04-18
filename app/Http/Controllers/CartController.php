<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $cart = Cart::instance(Auth::user()->id)->content();
    $total = 0;
    $hasCarriageCost = false;
    $carriageCost = 0;

    foreach ($cart as $c) {
      $total += $c->qty * $c->price;
      if ($c->options->carriage) {
        $hasCarriageCost = true;
      }
    }

    if ($hasCarriageCost) {
      $total += env('CARRIAGE');
      $carriageCost = env('CARRIAGE');
    }

    return view('carts.index', compact('cart', 'total', 'carriageCost'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    Cart::instance(Auth::user()->id)->add([
      'id' => $request->id,
      'name' => $request->name,
      'qty' => $request->qty,
      'price' => $request->price,
      'weight' => $request->weight,
      'options' => [
        'image' => $request->image,
        'carriage' => $request->carriage,
      ],
    ]);
    return to_route('products.show', $request->get('id'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    $userShoppingCarts = DB::table('shoppingcart')->get();
    $number = DB::table('shoppingcart')
      ->where('instance', Auth::user()->id)
      ->count();

    $count = $userShoppingCarts->count();

    $count += 1;
    $number += 1;
    $cart = Cart::instance(Auth::user()->id)->content();

    $priceTotal = 0;
    $qtyTotal = 0;
    $hasCarriageCost = false;

    foreach ($cart as $c) {
      $priceTotal += $c->qty * $c->price;
      $qtyTotal += $c->qty;
      if ($c->options->carriage) {
        $hasCarriageCost = true;
      }

      if ($hasCarriageCost) {
        $priceTotal += env('CARRIAGE');
      }

      Cart::instance(Auth::user()->id)->store($count);

      DB::table('shoppingcart')
        ->where('instance', Auth::user()->id)
        ->where('number', null)
        ->update([
          'code' => substr(
            str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'),
            0,
            10
          ),
          'number' => $number,
          'price_total' => $priceTotal,
          'qty' => $qtyTotal,
          'buy_flag' => true,
          'updated_at' => date('Y/m/d H:i:s'),
        ]);

      $pay_jp_secret = env('PAYJP_SECRET_KEY');
      \Payjp\Payjp::setApiKey($pay_jp_secret);

      $user = Auth::user();

      $res = \Payjp\Charge::create([
        'customer' => $user->token,
        'amount' => $priceTotal,
        'currency' => 'jpy',
      ]);
    }

    Cart::instance(Auth::user()->id)->destroy();

    return to_route('carts.index');
  }
}
