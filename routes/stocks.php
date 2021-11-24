<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/stocks', [\App\Http\Controllers\StocksController::class, 'index'])
    ->name('admin_stocks_get');

Route::get('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'unit'])
    ->name('admin_stock_units_get');

Route::post('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'create'])
    ->name('admin_stock_units_post');

