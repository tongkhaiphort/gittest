<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\PurchasesDetailController;
use Illuminate\Support\Facades\Route;
// api routes for the application
Route::apiResource('/products', ProductController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/orders', \App\Http\Controllers\OrderController::class);
Route::apiResource('/staff', \App\Http\Controllers\StaffController::class);
Route::apiResource('/order-details', OrderDetailController::class);
Route::apiResource('/payments', PaymentController::class);
Route::apiResource('/purchases', PurchasesController::class);
Route::apiResource('/purchase-details', PurchasesDetailController::class);
Route::apiResource('/customers', \App\Http\Controllers\CustomerController::class);
Route::apiResource('/suppliers', \App\Http\Controllers\SuppliersController::class);
