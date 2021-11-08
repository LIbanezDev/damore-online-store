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

Route::view('/', 'welcome')->name('Index');

// Auth
Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'registerClient']);
});

Route::middleware(['auth'])->group(function () {
    Route::view('/profile', 'user.profile')->name('User::profile');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'can:acceder a cpanel'])->group(function () {
    Route::get('/cpanel', [AuthController::class, 'getCpanelView'])->name('cpanel');

    Route::middleware(['can:gestionar roles y permisos'])->group(function () {
        Route::post('create_rol', [AuthController::class, 'createRole'])->name('Rol::create');
        Route::post('create_permission', [AuthController::class, 'createPermission'])->name('Permission::create');;
    });

});

// Products
Route::view('/products', 'products')->name('Products::index');
Route::view('/product', 'product')->name('Product::profile');

// Postman testing
Route::get('token', function () {
    return csrf_token();
});
