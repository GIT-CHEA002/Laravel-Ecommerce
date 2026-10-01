<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;

// Guest-only routes (login/register)
Route::middleware('guest')->group(function () {
  Route::get('/auth/login', [SessionController::class, 'create'])->name('login-user');
  Route::post('/auth/login', [SessionController::class, 'store'])->name('login-store-user');

  Route::get('/auth/register', [RegisteredUserController::class, 'create'])->name('register-user');
  Route::post('/auth/register', [RegisteredUserController::class, 'store'])->name('register-store-user');
});

// Auth-only routes
Route::middleware('auth')->group(function () {
  Route::delete('/auth/logout', [SessionController::class, 'destroy'])->name('logout-user');
});
