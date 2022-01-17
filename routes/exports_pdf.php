<?php

use Illuminate\Support\Facades\Route;

// Export to PDF
Route::get('/admin/orders/export/pdf', [\App\Http\Controllers\OrdersController::class, 'adminIndexExportToPdf'])
    ->middleware('auth.admin')
    ->name('admin_export_pdf_orders_get');
