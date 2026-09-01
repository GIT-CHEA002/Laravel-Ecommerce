<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController as ClientSideProductController;

Route::get('/client/product', [ClientSideProductController::class, 'index']);
