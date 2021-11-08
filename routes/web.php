<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CpanelController;
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
    Route::view('login', 'auth.login')->name('login');
    Route::view('register', 'auth.register')->name('register');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'registerClient']);
});

Route::middleware(['auth'])->group(function () {
    Route::view('profile', 'user.profile')->name('User::profile');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['can:acceder a cpanel'])->group(function () {
    Route::view('cpanel', 'cpanel.index')->name('Cpanel');

    Route::middleware(['can:gestionar roles y permisos'])->group(function () {
        Route::get('cpanel/roles', [CpanelController::class, 'getCpanelRolesView'])->name('Cpanel::roles');
        Route::post('roles/modify', [CpanelController::class, 'assignRoles'])->name('Rol::modifyByUser');
    });

    Route::middleware(['can:gestionar usuarios administradores'])->group(function () {
        Route::get('cpanel/usuarios', [CpanelController::class, 'getCpanelUsersView'])->name('Cpanel::usuarios');
    });

    Route::middleware(['can:crear productos'])->group(function () {
        Route::get('cpanel/productos', [CpanelController::class, 'getCpanelProductsView'])->name('Cpanel::productos');
    });
});

// Products
Route::view('/products', 'products')->name('Products::index');
Route::view('/product', 'product')->name('Product::profile');

// Postman testing
Route::get('token', function () {
    return csrf_token();
});
