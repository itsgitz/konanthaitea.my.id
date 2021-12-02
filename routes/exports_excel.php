<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/export/excel/orders', [\App\Http\Controllers\ExportController::class, 'orders'])
    ->name('admin_export_excel_orders_get');

Route::get('/admin/export/excel/restock_histories', [\App\Http\Controllers\ExportController::class, 'restockHistories'])
    ->name('admin_export_excel_restock_histories_get');
