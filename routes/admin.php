<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;


// Product routes

Route::get('/admin/product', [AdminProductController::class, 'index']);
Route::get('/admin/product/create', [AdminProductController::class, 'create']);
Route::post('/admin/product', [AdminProductController::class, 'store']);
Route::get('/admin/product/{product}', [AdminProductController::class, 'show']);
Route::get('/admin/product/{product}/edit', [AdminProductController::class, 'edit']);
Route::patch('/admin/product/{product}', [AdminProductController::class, 'update']);
Route::delete('/admin/product/{product}', [AdminProductController::class, 'destroy']);

// Category routes
Route::get('/admin/category', [AdminCategoryController::class, 'index']);
Route::get('/admin/category/create', [AdminCategoryController::class, 'create']);
Route::post('/admin/category', [AdminCategoryController::class, 'store']);
Route::get('/admin/category/{category}', [AdminCategoryController::class, 'show']);
Route::get('/admin/category/{category}/edit', [AdminCategoryController::class, 'edit']);
Route::patch('/admin/category/{category}', [AdminCategoryController::class, 'update']);
Route::delete('/admin/category/{category}', [AdminCategoryController::class, 'destroy']);

// Orders Routes 
Route::get('/admin/order', [AdminOrderController::class, 'index']);
Route::get('/admin/order/create', [AdminOrderController::class, 'create']);
Route::post('/admin/order', [AdminOrderController::class, 'store']);
Route::get('/admin/order/{order}', [AdminOrderController::class, 'show']);
Route::get('/admin/order/{order}/edit', [AdminOrderController::class, 'edit']);
Route::patch('/admin/order/{order}', [AdminOrderController::class, 'update']);
Route::delete('/admin/order/{order}', [AdminOrderController::class, 'destroy']);

// Users Routes

Route::get('/admin/users', [AdminUserController::class, 'index']);
Route::get('/admin/users/create', [AdminUserController::class, 'create']);
Route::post('/admin/users', [AdminUserController::class, 'store']);
Route::get('/admin/users/{user}', [AdminUserController::class, 'show']);
Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit']);
Route::patch('/admin/users/{user}', [AdminUserController::class, 'update']);
Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy']);


// Report Controller 
Route::get('/admin/report', [AdminReportController::class, 'index']);
Route::get('/admin/report/sales', [AdminReportController::class, 'sales']);
Route::get('/admin/report/categories', [AdminReportController::class, 'categories']);
Route::get('/admin/report/orders', [AdminReportController::class, 'orders']);
Route::get('/admin/report/products', [AdminReportController::class, 'products']);
Route::get('/admin/report/customers', [AdminReportController::class, 'customers']);
