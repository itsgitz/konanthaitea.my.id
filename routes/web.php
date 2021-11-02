<?php

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

//Login routes
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])
    ->middleware('guest')
    ->name('client_login');

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'auth'])
    ->middleware('guest')
    ->name('client_login_post');

Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('client_logout_post');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('auth')
    ->name('client_home');

Route::get('/minuman/orders', [\App\Http\Controllers\OrdersController::class, 'clientIndex'])
    ->middleware('auth')
    ->name('client_orders');

Route::get('/minuman/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'clientShow'])
    ->middleware('auth')
    ->name('client_orders_get');

Route::post('/minuman/orders/{menuId}', [\App\Http\Controllers\OrdersController::class, 'clientProcess'])
    ->middleware('auth')
    ->name('client_orders_post');

//Admin routes
Route::get('/admin', [\App\Http\Controllers\AdminsController::class, 'index'])->name('admin_home');
Route::get('/admin/stocks', [\App\Http\Controllers\StocksController::class, 'index'])->name('admin_stocks');
Route::get('/admin/menus', [\App\Http\Controllers\MenusController::class, 'index'])->name('admin_menus');
Route::get('/admin/menus/{id}', [\App\Http\Controllers\MenusController::class, 'show'])->name('admin_menu_show');
Route::get('/admin/orders', [\App\Http\Controllers\OrdersController::class, 'adminIndex'])->name('admin_orders');
Route::get('/admin/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'adminShow'])->name('admin_orders_show');
Route::post('/admin/orders/process/{id}', [\App\Http\Controllers\OrdersController::class, 'adminProcess'])->name('admin_orders_post');
Route::get('/admin/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('admin_invoices');
