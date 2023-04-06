<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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

Route::post('reviews', [ReviewController::class, 'store'])->name(
  'reviews.store'
);

Route::resource('products', ProductController::class)->middleware([
  'auth',
  'verified',
]);

Auth::routes(['verify' => true]);

Route::get('/home', [
  App\Http\Controllers\HomeController::class,
  'index',
])->name('home');
