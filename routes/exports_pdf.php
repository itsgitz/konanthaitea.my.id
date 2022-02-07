<?php

use Illuminate\Support\Facades\Route;

// Export to PDF
// Orders list
Route::post('/admin/orders/export/pdf', [\App\Http\Controllers\OrdersController::class, 'adminIndexExportToPdf'])
    ->middleware('auth.admin')
    ->name('admin_export_pdf_orders_post');

// Export pengajuan
Route::get('/admin/stocks/request_stocks/export/{id}', [\App\Http\Controllers\StocksController::class, 'requestStocksExport'])
    ->middleware('auth.admin')
    ->name('admin_export_pdf_request_stock_get');

// Export restock
Route::post('/admin/stocks/restock_histories/export/pdf', [\App\Http\Controllers\RestockHistoriesController::class, 'export'])
    ->middleware('auth.admin')
    ->name('admin_export_pdf_restock_histories_post');
