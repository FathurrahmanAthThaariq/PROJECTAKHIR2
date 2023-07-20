<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;


Route::name('backend.')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class)->middleware('role:admin');

    // Products
    Route::resource('products', ProductController::class)->middleware('role:admin|manager');
    Route::get('products/{product}/addStock', [ProductController::class, 'addStock'])->name('products.addStock')->middleware('role:manager');
    Route::post('products/{product}/updateStock', [ProductController::class, 'updateStock'])->name('products.updateStock')->middleware('role:manager');

    // Settings
    Route::prefix('settings')->name('settings.')->middleware('role:admin')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('index');
        Route::put('update_site', [SettingController::class, 'update_site'])->name('update_site');
        Route::put('update_user', [SettingController::class, 'update_user'])->name('update_user');
        Route::put('update_seo', [SettingController::class, 'update_seo'])->name('update_seo');
    });

    // Orders
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('', [OrderController::class, 'index'])->name('index');
        Route::get('{order}', [OrderController::class, 'show'])->name('show');
        Route::put('{order}/approve', [OrderController::class, 'approve'])->name('approve')->middleware('role:manager');
        Route::put('{order}/reject', [OrderController::class, 'reject'])->name('reject')->middleware('role:manager');
    });

    Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');
});
