<?php

use Illuminate\Support\Facades\Route;

//
//Admin routes
//
Route::get('/admin', [\App\Http\Controllers\AdminsController::class, 'index'])->name('admin_home');
Route::get('/admin/stocks', [\App\Http\Controllers\StocksController::class, 'index'])->name('admin_stocks');
Route::get('/admin/menus', [\App\Http\Controllers\MenusController::class, 'index'])->name('admin_menus');
Route::get('/admin/menus/{id}', [\App\Http\Controllers\MenusController::class, 'show'])->name('admin_menu_show');
Route::get('/admin/orders', [\App\Http\Controllers\OrdersController::class, 'adminIndex'])->name('admin_orders');
Route::get('/admin/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'adminShow'])->name('admin_orders_show');
Route::post('/admin/orders/process/{id}', [\App\Http\Controllers\OrdersController::class, 'adminProcess'])->name('admin_orders_post');
Route::get('/admin/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('admin_invoices');
