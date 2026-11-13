<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rules\Can;

Route::middleware(['auth', 'admin'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Products
    Route::prefix('products')->name('products.')->group(function () {
      Route::get('/', [AdminProductController::class, 'index'])->name('index');
      // protected route
      Route::get('/create', [AdminProductController::class, 'create'])
        ->name('create');
      Route::post('/', [AdminProductController::class, 'store'])
        ->name('store');
      Route::get('/{product}', [AdminProductController::class, 'show'])->name('show');
      Route::get('/{product}/edit', [AdminProductController::class, 'edit'])
        ->can('update', 'product')
        ->name('edit');
      Route::patch('/{product}', [AdminProductController::class, 'update'])
        ->can('update', 'product')
        ->name('update');
      Route::delete('/{product}', [AdminProductController::class, 'destroy'])
        ->can('delete', 'product')
        ->name('destroy');
      Route::delete('/{product}/force', [AdminProductController::class, 'forceDelete'])
        ->withTrashed() // trash the product (force it)
        ->can('forceDelete', 'product')
        ->name('forceDelete');
      Route::patch('/{product}/restore', [AdminProductController::class, 'restore'])
        ->can('restore', 'product')
        ->name('restore');
    });
    // Category
    Route::prefix('category')->name('category.')->group(function () {
      Route::get('/', [AdminCategoryController::class, 'index'])
        ->can('viewAny', Category::class)
        ->name('index');
      // protected route 
      Route::get('/create', [AdminCategoryController::class, 'create'])
        ->can('create', Category::class)
        ->name('create');
      Route::post('/', [AdminCategoryController::class, 'store'])
        ->can('create', Category::class)
        ->name('store');
      Route::get('/{category}', [AdminCategoryController::class, 'show'])
        ->name('show');
      Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])
        ->name('edit');
      Route::patch('/{category}', [AdminCategoryController::class, 'update'])
        ->name('update');
      Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])
        ->can('delete', 'category')
        ->name('destroy');
      Route::delete('/{category}/force', [AdminCategoryController::class, 'forceDelete'])
        ->can('forceDelete', 'category')
        ->name('forceDelete');
      Route::patch('/{category}/restore', [AdminCategoryController::class, 'restore'])
        ->can('restore', 'category')
        ->name('restore');
      Route::patch('/{category}/products/{product}/detach', [AdminCategoryController::class, 'detachProduct'])
        ->can('update', 'product')
        ->name('products.detach');
      Route::get('/{category}/product/attach', [AdminCategoryController::class, 'attachProductIndex'])
        ->can('update', 'category')
        ->name('product.attach.index');
      Route::patch('/{category}/products/attach', [AdminCategoryController::class, 'attachProduct'])
        ->can('update', 'category')
        ->name('product.attach');
    });
    // Orders (no create/edit/delete: admins only view and update status)
    Route::prefix('orders')->name('orders.')->group(function () {
      Route::get('/', [AdminOrderController::class, 'index'])
        ->name('index');
      Route::get('/{order}', [AdminOrderController::class, 'show'])
        ->name('show');
      Route::patch('/{order}', [AdminOrderController::class, 'update'])
        ->name('update');
      Route::delete('/{order}', [AdminOrderController::class, 'destroy']);
    });

    // Users : display admins
    Route::prefix('user')->name('user.')->group(function () {
      Route::get('/', [AdminUserController::class, 'index'])
        ->name('index');
      Route::get('/admin', [AdminUserController::class, 'admin'])
        ->can('viewAny', User::class)
        ->name('admin');
      Route::get('/client', [AdminUserController::class, 'client'])
        ->name('client');
      Route::get('/create', [AdminUserController::class, 'create'])
        ->name('create');
      Route::post('/', [AdminUserController::class, 'store'])
        ->name('store');

      // showing route : separate by admin and client
      Route::get('/admin/{user}', [AdminUserController::class, 'show'])
        ->can('view', 'user')
        ->name('admin.show');
      Route::get('/client/{user}', [AdminUserController::class, 'show'])
        ->name('client.show');

      Route::get('/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('edit');
      Route::patch('/{user}', [AdminUserController::class, 'update'])
        ->can('update', 'user')
        ->name('admin.update');

      Route::delete('/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.destroy');
      Route::patch('/{user}/restore', [AdminUserController::class, 'restore'])
        ->name('admin.restore');
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
