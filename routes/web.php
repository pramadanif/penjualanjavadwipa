<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesmanController;
use App\Http\Controllers\OrderController;


Auth::routes();
// route untuk Customer
Route::prefix('customers')->name('customers.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('destroy');
});

// route untuk Salesman
Route::prefix('salesmans')->name('salesmans.')->group(function () {
    Route::get('/', [SalesmanController::class, 'index'])->name('index');
    Route::get('/create', [SalesmanController::class, 'create'])->name('create');
    Route::post('/', [SalesmanController::class, 'store'])->name('store');
    Route::get('/{id}', [SalesmanController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SalesmanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SalesmanController::class, 'update'])->name('update');
    Route::delete('/{id}', [SalesmanController::class, 'destroy'])->name('destroy');
});

// route untuk Order
Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('edit');
    Route::put('/{id}', [OrderController::class, 'update'])->name('update');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
});


