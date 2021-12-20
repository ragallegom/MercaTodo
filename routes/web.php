<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Controller;
use \App\Http\Controllers\UserController;

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

