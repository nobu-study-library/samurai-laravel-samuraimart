<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
  return view('welcome');
});

Route::controller(UserController::class)->group(function () {
  Route::get('users/mypage', 'mypage')->name('maypage');
  Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
  Route::put('users/mypage', 'update')->name('mypage.update');
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
