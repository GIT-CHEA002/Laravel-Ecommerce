<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController as ClientSideProductController;
use App\Http\Controllers\Client\CartController as ClientCartController;

// product diplay route for user only
Route::get('/client/product', [ClientSideProductController::class, 'index']);
Route::get('/client/product/{product}', [ClientSideProductController::class, 'show']);

// Cart 
Route::get('/client/cart', [ClientCartController::class, 'index']);
Route::post('/client/cart/{product}', [ClientCartController::class, 'store']); // middle ware protect

