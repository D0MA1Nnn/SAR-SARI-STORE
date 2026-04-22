<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockListController;
use App\Http\Controllers\CashLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'customers' => CustomerController::class,
        'sales' => SaleController::class,
        'payments' => PaymentController::class,
        'block-list' => BlockListController::class,
        'logs' => CashLogController::class,
    ]);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
