<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/stocks', [\App\Http\Controllers\StocksController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin_stocks_get');

Route::get('/admin/stocks/add', [\App\Http\Controllers\StocksController::class, 'create'])
    ->middleware('auth.admin')
    ->name('admin_stocks_add_get');

Route::post('/admin/stocks/add', [\App\Http\Controllers\StocksController::class, 'store'])
    ->middleware('auth.admin')
    ->name('admin_stocks_add_post');

Route::get('/admin/stocks/edit/add/quantity/{id}', [\App\Http\Controllers\StocksController::class, 'editAddQuantity'])
    ->middleware('auth.admin')
    ->name('admin_stocks_edit_add_quantity_get');

Route::put('/admin/stocks/edit/add/quantity/{id}', [\App\Http\Controllers\StocksController::class, 'updateAddQuantity'])
    ->middleware('auth.admin')
    ->name('admin_stocks_edit_add_quantity_put');

Route::get('/admin/stocks/edit/{id}', [\App\Http\Controllers\StocksController::class, 'edit'])
    ->middleware('auth.admin')
    ->name('admin_stocks_edit_get');

Route::put('/admin/stocks/edit/{id}', [\App\Http\Controllers\StocksController::class, 'update'])
    ->middleware('auth.admin')
    ->name('admin_stocks_edit_put');

Route::get('/admin/stocks/delete/{id}', [\App\Http\Controllers\StocksController::class, 'delete'])
    ->middleware('auth.admin')
    ->name('admin_stocks_delete_get');

//Stock Unit
Route::get('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin_stock_units_get');

Route::post('/admin/stocks/unit/add', [\App\Http\Controllers\StockUnitsController::class, 'create'])
    ->middleware('auth.admin')
    ->name('admin_stock_units_post');

Route::get('/admin/stocks/unit/edit/{id}', [\App\Http\Controllers\StockUnitsController::class, 'edit'])
    ->middleware('auth.admin')
    ->name('admin_stock_units_edit_get');

Route::put('/admin/stocks/unit/edit/{id}', [\App\Http\Controllers\StockUnitsController::class, 'update'])
    ->middleware('auth.admin')
    ->name('admin_stock_units_edit_put');

Route::get('/admin/stocks/unit/delete/{id}', [\App\Http\Controllers\StockUnitsController::class, 'delete'])
    ->middleware('auth.admin')
    ->name('admin_stock_units_delete_get');
