<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Controller;

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

Route::get('/home', function () {
   return view('home');
})->middleware(['auth', 'verified']);

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->middleware('auth');

Route::get('lang/{locale}', [Controller::class, 'setLanguage']);
