<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

Route::middleware(['auth', 'admin', 'nocache'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::prefix('products')->name('products.')->group(function () {
      Route::get('/', [AdminProductController::class, 'index'])->name('index');
      Route::get('/create', [AdminProductController::class, 'create'])->name('create');
      Route::post('/', [AdminProductController::class, 'store'])->name('store');
      Route::get('/{product}', [AdminProductController::class, 'show'])->name('show');
      Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
      Route::patch('/{product}', [AdminProductController::class, 'update'])->name('update');
      Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
    });

    // Categories
    Route::prefix('categories')->name('categories.')->group(function () {
      Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
      Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
      Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
      Route::get('/{category}', [AdminCategoryController::class, 'show'])->name('show');
      Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
      Route::patch('/{category}', [AdminCategoryController::class, 'update'])->name('update');
      Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });

    // Orders (no create/edit/delete: admins only view and update status)
    Route::prefix('orders')->name('orders.')->group(function () {
      Route::get('/', [AdminOrderController::class, 'index'])->name('index');
      Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
      Route::patch('/{order}', [AdminOrderController::class, 'update'])->name('update');
    });

    // Users
    Route::prefix('users')->name('users.')->group(function () {
      Route::get('/', [AdminUserController::class, 'index'])->name('index');
      Route::get('/create', [AdminUserController::class, 'create'])->name('create');
      Route::post('/', [AdminUserController::class, 'store'])->name('store');
      Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
      Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
      Route::patch('/{user}', [AdminUserController::class, 'update'])->name('update');
      Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
      Route::get('/', [AdminReportController::class, 'index'])->name('index');
      Route::get('/sales', [AdminReportController::class, 'sales'])->name('sales');
      Route::get('/categories', [AdminReportController::class, 'categories'])->name('categories');
      Route::get('/orders', [AdminReportController::class, 'orders'])->name('orders');
      Route::get('/products', [AdminReportController::class, 'products'])->name('products');
      Route::get('/customers', [AdminReportController::class, 'customers'])->name('customers');
    });
  });
