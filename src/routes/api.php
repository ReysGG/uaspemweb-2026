<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Public endpoints
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);

    // Authenticated endpoints
    Route::middleware('auth:sanctum')->group(function () {
        // Sales
        Route::get('/sales', [SaleController::class, 'index']);
        Route::get('/sales/{id}', [SaleController::class, 'show']);
        Route::get('/sales/{id}/tracking', [SaleController::class, 'tracking']);
        Route::patch('/sales/{id}/status', [SaleController::class, 'updateStatus']);

        // Dashboard
        Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    });
});
