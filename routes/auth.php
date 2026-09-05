<?php

use App\Http\Controllers\Auth\RegisteredUserController as RegisteredUserController;
use App\Http\Controllers\Auth\SessionController as SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('/auth/login', [SessionController::class, 'create'])->name('login-user'); // should use middleware 
  Route::post('/auth/login', [SessionController::class, 'store']);
  Route::delete('/auth/logout', [SessionController::class, 'destroy'])->name('logout-user'); // should use middleware
});
Route::middleware('guest')->group(function () {
  Route::get('/auth/register', [RegisteredUserController::class, 'create'])->name('register-user');
  Route::post('/auth/register', [RegisteredUserController::class, 'store']);
});
