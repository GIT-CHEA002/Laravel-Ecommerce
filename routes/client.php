<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController as ClientSideProductController;

// product diplay route for user only
Route::get('/client/product', [ClientSideProductController::class, 'index']);
Route::get('/client/product/{product}', [ClientSideProductController::class, 'show']);
