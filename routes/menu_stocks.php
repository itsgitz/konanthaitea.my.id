<?php

use Illuminate\Support\Facades\Route;

Route::post('/admin/menus/stocks/{id}', [\App\Http\Controllers\MenuStocksController::class, 'store'])
    ->middleware('auth.admin')
    ->name('admin_menu_stocks_add_post');

Route::get('/admin/menus/stocks/edit/{id}', [\App\Http\Controllers\MenuStocksController::class, 'update'])
    ->middleware('auth.admin')
    ->name('admin_menu_stocks_edit_get');

Route::get('/admin/menus/stocks/delete/{id}', [\App\Http\Controllers\MenuStocksController::class, 'delete'])
    ->middleware('auth.admin')
    ->name('admin_menu_stocks_delete_get');
