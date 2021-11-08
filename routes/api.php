<?php

use App\Http\Controllers\CpanelController;
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

Route::get('roles', [CpanelController::class, 'getRoles'])->name('Rol::getAll');
Route::get('roles/{id?}', [CpanelController::class, 'getRole'])->name('Rol::getOne');
Route::post('roles', [CpanelController::class, 'createRole'])->name('Rol::create');

// TODO: implement authorization on api routes

/*Route::middleware(['can:acceder a cpanel'])->group(function () {
    Route::middleware(['can:gestionar roles y permisos'])->group(function () {

    });
});*/
