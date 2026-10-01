<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController as ClientHomeController;

Route::get('/', [ClientHomeController::class, 'index'])->name('client.home');

require __DIR__ . '/auth.php';

require __DIR__ . '/client.php';

require __DIR__ . '/admin.php';
