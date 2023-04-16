<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WebController::class, 'index']);

Route::controller(CartController::class)->group(function () {
  Route::get('users/carts', 'index')->name('carts.index');
  Route::post('users/carts', 'store')->name('carts.store');
  Route::delete('users/carts', 'destroy')->name('carts.destroy');
});

Route::controller(UserController::class)->group(function () {
  Route::get('users/mypage', 'mypage')->name('mypage');
  Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
  Route::put('users/mypage', 'update')->name('mypage.update');
  Route::get('users/mypage/password/edit', 'editPassword')->name(
    'mypage.editPassword'
  );
  Route::put('users/mypage/password', 'updatePassword')->name(
    'mypage.updatePassword'
  );
  Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
});

Route::post('reviews', [ReviewController::class, 'store'])->name(
  'reviews.store'
);

Route::get('products/{product}/favorite', [
  ProductController::class,
  'favorite',
])->name('products.favorite');

Route::resource('products', ProductController::class)->middleware([
  'auth',
  'verified',
]);

Auth::routes(['verify' => true]);

Route::get('/home', [
  App\Http\Controllers\HomeController::class,
  'index',
])->name('home');
