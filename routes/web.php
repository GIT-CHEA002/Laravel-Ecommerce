<?php

use App\Http\Controllers\Auth\RegisteredUserController as RegisteredUserController;
use App\Http\Controllers\Auth\SessionController as SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// register controller
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

// login controller
Route::get('/login', [SessionController::class, 'create']); // should use middleware 
Route::post('/login', [SessionController::class, 'store']);
Route::delete('/login', [SessionController::class, 'destroy']); // should use middleware

require __DIR__ . '/client.php';

require __DIR__ . '/admin.php';
