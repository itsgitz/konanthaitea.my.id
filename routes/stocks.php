<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/stocks', [\App\Http\Controllers\StocksController::class, 'index'])
    ->name('admin_stocks_get');

Route::get('/admin/stocks/add', [\App\Http\Controllers\StocksController::class, 'create'])
    ->name('admin_stocks_add_get');

Route::post('/admin/stocks/add', [\App\Http\Controllers\StocksController::class, 'store'])
    ->name('admin_stocks_add_post');

Route::get('/admin/stocks/edit/{id}', [\App\Http\Controllers\StocksController::class, 'edit'])
    ->name('admin_stocks_edit_get');

Route::put('/admin/stocks/edit/{id}', [\App\Http\Controllers\StocksController::class, 'update'])
    ->name('admin_stocks_edit_post');

Route::get('/admin/stocks/delete/{id}', [\App\Http\Controllers\StocksController::class, 'delete'])
    ->name('admin_stocks_delete_get');

//Stock Unit
Route::get('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'index'])
    ->name('admin_stock_units_get');

Route::post('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'create'])
    ->name('admin_stock_units_post');

Route::get('/admin/stocks/unit/edit/{id}', [\App\Http\Controllers\StockUnitsController::class, 'edit'])
    ->name('admin_stock_units_edit_get');

Route::put('/admin/stocks/unit/edit/{id}', [\App\Http\Controllers\StockUnitsController::class, 'update'])
    ->name('admin_stock_units_edit_put');

Route::get('/admin/stocks/unit/delete/{id}', [\App\Http\Controllers\StockUnitsController::class, 'delete'])
    ->name('admin_stock_units_delete_get');
