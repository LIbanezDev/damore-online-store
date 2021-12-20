<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CpanelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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
});

Route::post('register', [AuthController::class, 'registerClient'])->name('registerClient');
Route::middleware(['auth'])->group(function () {
    Route::get('profile', [UsersController::class, 'getProfileView'])->name('User::profile');
    Route::post('profile', [UsersController::class, 'updateUser'])->name('User::update');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['can:acceder a cpanel'])->group(function () {
    Route::view('cpanel', 'cpanel.index')->name('Cpanel');

    Route::middleware(['can:gestionar roles y permisos'])->group(function () {
        Route::get('cpanel/roles', [CpanelController::class, 'getCpanelRolesView'])->name('Cpanel::roles');
        Route::post('roles/modify', [RolesController::class, 'assignRoles'])->name('Rol::modifyByUser');
        Route::post('roles/delete', [RolesController::class, 'removeRole'])->name('Rol::remove');
    });

    Route::middleware(['can:gestionar usuarios administradores'])->group(function () {
        Route::get('cpanel/usuarios', [CpanelController::class, 'getCpanelUsersView'])->name('Cpanel::usuarios');
    });

    Route::middleware(['can:gestionar pedidos'])->group(function () {
        Route::get('cpanel/orders', [CpanelController::class, 'getCpanelOrdersView'])->name('Cpanel::ordenes');
    });

    Route::middleware(['can:crear productos'])->group(function () {
        Route::post('products/categories', [ProductController::class, 'createCategory'])->name('Category::create');
        Route::post('products/providers', [ProductController::class, 'createProvider'])->name('Provider::create');
        Route::get('cpanel/productos', [CpanelController::class, 'getCpanelProductsView'])->name('Cpanel::productos');
    });
});

// Products
Route::get('/productos', [ProductController::class, 'getProductsView'])->name('Products::index');
Route::get('/productos/{name}', [ProductController::class, 'getProductView'])->name('Products::getOne');
Route::view('/preguntas-frecuentes', 'faq')->name('Main::faq');
Route::view('/carrito', 'shopping_cart')->name('ShoppingCart::index');
Route::view('/nosotros', 'about_us')->name('Main::about_us');
Route::view('/confirmar-pago', 'payment_page')->name('Main::confirm_payment');


// Postman testing
Route::get('token', function () {
    return csrf_token();
});
