<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PlannedPaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    //User routes
    Route::apiResource('users', UserController::class);
    // Account routes
    Route::apiResource('accounts', AccountController::class);

    // Category routes
    Route::apiResource('categories', CategoryController::class);

    // Currency routes
    Route::apiResource('currencies', CurrencyController::class);

    // Transaction routes
    Route::apiResource('transactions', TransactionController::class);

    // Wishlist routes
    Route::apiResource('wishlist', WishlistController::class);

    // PlannedPayment routes
    Route::apiResource('planned-payments', PlannedPaymentController::class);
});
