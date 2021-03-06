<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Controller;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\WebCheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [UserController::class, 'index']
)->middleware(['auth', 'verified']);

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->middleware('auth');

Route::get('/profile/password', function () {
    return view('profile.password');
})->middleware('auth');

Route::get('lang/{locale}', [Controller::class, 'setLanguage']);

Route::get('/users', [UserController::class, 'index']);

Route::resource('store/category', CategoryController::class)
    ->name('index', 'category.index')
    ->name('edit', 'category.edit')
    ->name('update', 'category.update')
    ->name('destroy', 'category.delete');

Route::resource('store/product', ProductController::class)
    ->name('index', 'products.index');

Route::get('add-to-cart/{id}', [ProductController::class, 'getAddToCart'])->name('product.addToCart');

Route::get('increase-product/{id}', [ProductController::class, 'getIncreaseProductShopping'])->name('product.increaseProduct');
Route::get('decrease-product/{id}', [ProductController::class, 'getDecreaseProductShopping'])->name('product.decreaseProduct');

Route::get('shopping-cart', [ProductController::class, 'getCart'])->name('product.shoppingCart');

Route::get('checkout', [ProductController::class, 'getCheckout'])->name('product.checkout');

Route::post('checkout', [WebCheckoutController::class, 'createRequest'])->name('request.checkout');

Route::get('checkout_request/{id}', [WebCheckoutController::class, 'consultRequest'])->name('consult.checkout');

Route::resource('checkout/index', WebCheckoutController::class)
    ->name('index', 'checkout.index');

Route::get('retry_request/{id}', [WebCheckoutController::class, 'retryRequest'])->name('retry.checkout');
