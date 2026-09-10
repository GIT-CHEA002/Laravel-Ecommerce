<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController as ClientSideProductController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\CategoryController as ClientCategoryController;


// product diplay route for user only
Route::get('/client/product', [ClientSideProductController::class, 'index'])->name('products.index');
Route::get('/client/product/{product}', [ClientSideProductController::class, 'show'])->name('product.show');

// categories route 
// Route::get('/client/categories',[Ca])
Route::get('/client/category', [ClientCategoryController::class, 'index'])->name('category.index');

// Cart 
Route::get('/client/cart', [ClientCartController::class, 'index']);
Route::post('/client/cart/{product}', [ClientCartController::class, 'store']); // middle ware protect
