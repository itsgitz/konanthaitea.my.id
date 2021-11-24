<?php

use Illuminate\Support\Facades\Route;

//
//Admin routes
//
Route::get('/admin', [\App\Http\Controllers\AdminsController::class, 'index'])
    ->name('admin_home');

Route::get('/admin/stocks', [\App\Http\Controllers\StocksController::class, 'index'])
    ->name('admin_stocks_get');

Route::get('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'unit'])
    ->name('admin_stock_units_get');

Route::post('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'create'])
    ->name('admin_stock_units_post');

Route::get('/admin/menus', [\App\Http\Controllers\MenusController::class, 'index'])
    ->name('admin_menus_get');

Route::get('/admin/menus/{id}', [\App\Http\Controllers\MenusController::class, 'show'])
    ->name('admin_menu_show_get');

Route::get('/admin/orders', [\App\Http\Controllers\OrdersController::class, 'adminIndex'])
    ->name('admin_orders_get');

Route::get('/admin/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'adminShow'])
    ->name('admin_orders_show_get');

Route::put('/admin/orders/process/{id}', [\App\Http\Controllers\OrdersController::class, 'adminProcess'])
    ->name('admin_orders_process');

//Admin user management routes
Route::get('/admin/accounts', [\App\Http\Controllers\AdminsController::class, 'account'])
    ->name('admin_accounts_get');

Route::get('/admin/accounts/add', [\App\Http\Controllers\AdminsController::class, 'create'])
    ->name('admin_accounts_add_get');

Route::post('/admin/accounts/add', [\App\Http\Controllers\AdminsController::class, 'store'])
    ->name('admin_accounts_add_post');

Route::get('/admin/accounts/edit/{id}', [\App\Http\Controllers\AdminsController::class, 'edit'])
    ->name('admin_accounts_edit_get');

Route::put('/admin/accounts/edit/{id}', [\App\Http\Controllers\AdminsController::class, 'update'])
    ->name('admin_accounts_edit_put');

Route::get('/admin/accounts/delete/{id}', [\App\Http\Controllers\AdminsController::class, 'delete'])
    ->name('admin_accounts_delete_get');
