<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\ProductController as ClientSideProductController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\CategoryController as ClientCategoryController;

// Public storefront: guests, customers, and admins
Route::middleware(['client', 'nocache'])->group(function () {
  Route::get('/', [ClientHomeController::class, 'index'])->name('client.home');
  Route::prefix('client')->group(function () {
    Route::get('/product', [ClientSideProductController::class, 'index'])->name('product.index');
    Route::get('/product/trending', [ClientSideProductController::class, 'trending'])->name('product.trending');
    Route::get('/product/{product}', [ClientSideProductController::class, 'show'])->name('product.show');

    Route::get('/category', [ClientCategoryController::class, 'index'])->name('category.index');
  });
});

// Customer-only: must be logged in and not an admin
Route::middleware(['auth', 'client', 'nocache'])
  ->prefix('client')
  ->group(function () {
    Route::get('/cart', [ClientCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [ClientCartController::class, 'store'])->name('cart.store');
  });
