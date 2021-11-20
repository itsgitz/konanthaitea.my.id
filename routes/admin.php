<?php

use Illuminate\Support\Facades\Route;

//
//Admin routes
//
Route::get('/admin', [\App\Http\Controllers\AdminsController::class, 'index'])->name('admin_home');
Route::get('/admin/stocks', [\App\Http\Controllers\StocksController::class, 'index'])->name('admin_stocks_get');
Route::get('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'unit'])->name('admin_stock_units_get');
Route::post('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'create'])->name('admin_stock_units_post');
Route::get('/admin/menus', [\App\Http\Controllers\MenusController::class, 'index'])->name('admin_menus_get');
Route::get('/admin/menus/{id}', [\App\Http\Controllers\MenusController::class, 'show'])->name('admin_menu_show_get');
Route::get('/admin/orders', [\App\Http\Controllers\OrdersController::class, 'adminIndex'])->name('admin_orders_get');
Route::get('/admin/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'adminShow'])->name('admin_orders_show_get');
Route::get('/admin/orders/process/{id}', [\App\Http\Controllers\OrdersController::class, 'adminProcess'])->name('admin_orders_process');
