<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
  use HasFactory;

  protected $table = 'shoppingcart';

  public static function getCurrentUserOrders($userId)
  {
    $shoppingCarts = DB::table('shoppingcart')
      ->where('instance', "{$userId}")
      ->get();

    $orders = [];

    foreach ($shoppingCarts as $order) {
      $orders[] = [
        'id' => $order->number,
        'created_at' => $order->updated_at,
        'total' => $order->price_total,
        'user_name' => User::find($order->instance)->name,
        'code' => $order->code,
      ];
    }

    return $orders;
  }
}
