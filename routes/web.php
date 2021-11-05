<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

// Auth
Route::view('/login', 'auth.login')->name('login')->middleware('guest');
Route::view('/register', 'auth.register')->name('register')->middleware('guest');
Route::view('/profile', 'user.profile')->name('User::profile')->middleware('auth');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Postman testing
Route::get('token', function () {
    return csrf_token();
});
