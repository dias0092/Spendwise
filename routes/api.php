<?php

use App\Http\Controllers\MonthlyBalanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Add the forgot-password and reset-password routes here
Route::post('forgot-password', [UserController::class, 'sendPasswordResetLink']);
Route::post('reset-password', [UserController::class, 'resetPassword']);

Route::middleware(['already_authenticated'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    //User routes
    Route::apiResource('users', UserController::class);
    // Account routes
    Route::apiResource('accounts', AccountController::class);

    // Currency routes
    Route::apiResource('currencies', CurrencyController::class);

    // Transaction routes
    Route::apiResource('transactions', TransactionController::class);
    Route::get('transactions/type/{type}', [TransactionController::class, 'getTransactionsByType']);

    // Goal routes
    Route::apiResource('goals', GoalController::class);
    Route::get('goals/status/{status}', [GoalController::class, 'getGoalsByStatus']);

    Route::apiResource('monthly-balances', MonthlyBalanceController::class);
});
