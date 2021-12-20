<?php

use App\Http\Controllers\CpanelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('roles/{id}/users', [RolesController::class, 'getRole'])->name('Users::getByRole');
Route::get('roles', [RolesController::class, 'getRoles'])->name('Rol::getAll');
Route::get('roles/{id?}', [RolesController::class, 'getRole'])->name('Rol::getOne');
Route::post('roles', [RolesController::class, 'createRole'])->name('Rol::create');

Route::delete('users/remove/{id}', [UsersController::class, 'removeUser'])->name('Users::remove');
Route::get('users', [UsersController::class, 'getAll'])->name('User::getAll');

Route::post('products', [ProductController::class, 'createProduct'])->name('Product::create');
Route::patch('products/{id}', [ProductController::class, 'updateStock'])->name('Product::update');
Route::get('products', [ProductController::class, 'getProducts'])->name('Product::getAll');
Route::delete('products/{id}', [ProductController::class, 'deleteProduct'])->name('Product::delete');
Route::post('orders', [OrderController::class, 'create'])->name('Order::create');
Route::post('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('Order::update');


/*Route::middleware(['can:acceder a cpanel'])->group(function () {
    Route::middleware(['can:gestionar roles y permisos'])->group(function () {

    });
});*/
