<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart;
use Illuminate\Pagination\LengthAwarePaginator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function mypage()
  {
    $user = Auth::user();
    return view('users.mypage', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    $user = Auth::user();
    return view('users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    $user = Auth::user();

    $user->name = $request->input('name')
      ? $request->input('name')
      : $user->name;
    $user->email = $request->input('email')
      ? $request->input('email')
      : $user->email;
    $user->postal_code = $request->input('postalCode')
      ? $request->input('postalCode')
      : $user->postal_code;
    $user->address = $request->input('address')
      ? $request->input('address')
      : $user->address;
    $user->phone = $request->input('phone')
      ? $request->input('phone')
      : $user->phone;

    $user->update();

    return to_route('mypage');
  }

  public function updatePassword(Request $request)
  {
    $user = Auth::user();

    if (
      $request->input('password') === $request->input('passwordConfirmation')
    ) {
      $user->password = bcrypt($request->input('password'));
      $user->update();
    } else {
      return to_route('mypage.edit_password');
    }

    return to_route('mypage');
  }

  public function editPassword()
  {
    return view('users.editPassword');
  }

  public function favorite()
  {
    $user = Auth::user();
    $favorites = $user->favorites(Product::class)->get();

    return view('users.favorite', compact('favorites'));
  }

  public function destroy(Request $request)
  {
    $user = Auth::user();

    if ($user->deleted_flag) {
      $user->deleted_flag = false;
    } else {
      $user->deleted_flag = true;
    }
    $user->update();

    Auth::logout();
    return redirect('/');
  }

  public function cartHistoryIndex(Request $request)
  {
    $page = $request->page != null ? $request->page : 1;
    $userId = Auth::user()->id;
    $billings = ShoppingCart::getCurrentUserOrders($userId);
    $total = count($billings);
    $billings = new LengthAwarePaginator(
      array_slice($billings, ($page - 1) * 15, 15),
      $total,
      15,
      $page,
      [
        'path' => $request->url(),
      ]
    );

    return view('users.cartHistoryIndex', compact('billings', 'total'));
  }

  public function cartHistoryShow(Request $request)
  {
    $num = $request->num;
    $userId = Auth::user()->id;
    $cartInfo = DB::table('shoppingcart')
      ->where('instance', $userId)
      ->where('number', $num)
      ->get()
      ->first();
    Cart::instance($userId)->restore($cartInfo->identifier);
    $cartContents = Cart::content();
    Cart::instance($userId)->store($cartInfo->identifier);
    Cart::destroy();

    DB::table('shoppingcart')
      ->where('instance', $userId)
      ->where('number', null)
      ->update([
        'code' => $cartInfo->code,
        'number' => $num,
        'price_total' => $cartInfo->price_total,
        'qty' => $cartInfo->qty,
        'buy_flag' => $cartInfo->buy_flag,
        'updated_at' => $cartInfo->updated_at,
      ]);

    return view('users.cartHistoryShow', compact('cartContents', 'cartInfo'));
  }

  public function registerCard(Request $request)
  {
    $user = Auth::user();

    $pay_jp_secret = env('PAYJP_SECRET_KEY');
    \Payjp\Payjp::setApiKey($pay_jp_secret);

    $card = [];
    $count = 0;

    if ($user->token != '') {
      $result = \Payjp\Customer::retrieve($user->token)->cards->all([
        'limit' => 1,
      ])->data[0];
      $count = \Payjp\Customer::retrieve($user->token)->cards->all()->count;

      $card = [
        'brand' => $result['brand'],
        'exp_month' => $result['exp_month'],
        'exp_year' => $result['exp_year'],
        'last4' => $result['last4'],
      ];
    }

    return view('users.registerCard', compact('card', 'count'));
  }

  public function token(Request $request)
  {
    $pay_jp_secret = env('PAYJP_SECRET_KEY');
    \Payjp\Payjp::setApiKey($pay_jp_secret);

    $user = Auth::user();
    $customer = $user->token;

    if ($customer != '') {
      $cu = \Payjp\Customer::retrieve($customer);
      $delete_card = $cu->cards->retrieve($cu->cards->data[0]['id']);
      $delete_card->delete();
      $cu->cards->create([
        'card' => request('payjp-token'),
      ]);
    } else {
      $cu = \Payjp\Customer::create([
        'card' => request('payjp-token'),
      ]);
      $user->token = $cu->id;
      $user->update();
    }

    return to_route('mypage');
  }
}
