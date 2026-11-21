<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Models\Category;
use App\Models\User;

Route::middleware(['auth', 'admin'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
      ->name('dashboard');

    // Products
    Route::controller(AdminProductController::class)
      ->prefix('product')
      ->name('product.')
      ->group(function () {
        Route::get('/', 'index')
          ->name('index');
        // protected route
        Route::get('/create', 'create')
          ->name('create');
        Route::post('/', 'store')
          ->name('store');
        Route::get('/{product}', 'show')
          ->name('show');
        Route::get('/{product}/edit', 'edit')
          ->can('update', 'product')
          ->name('edit');
        Route::patch('/{product}', 'update')
          ->can('update', 'product')
          ->name('update');
        Route::delete('/{product}', 'destroy')
          ->can('delete', 'product')
          ->name('destroy');
        Route::delete('/{product}/force', 'forceDelete')
          ->withTrashed() // trash the product (force it)
          ->can('forceDelete', 'product')
          ->name('forceDelete');
        Route::patch('/{product}/restore', 'restore')
          ->can('restore', 'product')
          ->name('restore');
      });

    // Category
    Route::controller(AdminCategoryController::class)
      ->prefix('category')
      ->name('category.')
      ->group(function () {
        Route::get('/', 'index')
          ->can('viewAny', Category::class)
          ->name('index');
        // protected route 
        Route::get('/create', 'create')
          ->can('create', Category::class)
          ->name('create');
        Route::post('/', 'store')
          ->can('create', Category::class)
          ->name('store');
        Route::get('/{category}', 'show')
          ->name('show');
        Route::get('/{category}/edit', 'edit')
          ->name('edit');
        Route::patch('/{category}', 'update')
          ->name('update');
        Route::delete('/{category}', 'destroy')
          ->can('delete', 'category')
          ->name('destroy');
        Route::delete('/{category}/force', 'forceDelete')
          ->can('forceDelete', 'category')
          ->name('forceDelete');
        Route::patch('/{category}/restore', 'restore')
          ->can('restore', 'category')
          ->name('restore');
        Route::patch('/{category}/products/{product}/detach', 'detachProduct')
          ->can('update', 'product')
          ->name('products.detach');
        Route::get('/{category}/product/attach', 'attachProductIndex')
          ->can('update', 'category')
          ->name('product.attach.index');
        Route::patch('/{category}/products/attach', 'attachProduct')
          ->can('update', 'category')
          ->name('product.attach');
      });

    // Orders (no create/edit/delete: admins only view and update status)
    Route::controller(AdminOrderController::class)
      ->prefix('order')
      ->name('order.')
      ->group(function () {
        Route::get('/', 'index')
          ->name('index');
        Route::get('/{order}', 'show')
          ->name('show');
        Route::patch('/{order}', 'update')
          ->name('update');
        Route::delete('/{order}', 'destroy');
      });

    // proifle routes 
    Route::controller(AdminProfileController::class)
      ->prefix('profile')
      ->name('profile.')
      ->group(function () {
        Route::get('/', 'index')
          ->name('index');
        Route::get('/{user}/edit', 'edit')
          ->can('updateProfile', 'user')
          ->name('edit');
        Route::patch('/{user}', 'updateProfile')
          ->can('updateProfile', 'user')
          ->name('update');
      });

    // Users : display admins
    Route::controller(AdminUserController::class)
      ->prefix('user')
      ->name('user.')
      ->group(function () {
        Route::get('/', 'index')
          ->name('index');
        Route::get('/admin', 'admin')
          ->can('viewAny', User::class)
          ->name('admin');
        Route::get('/client', 'client')
          ->name('client');
        Route::get('/create', 'create')
          ->name('create');
        Route::post('/', 'store')
          ->name('store');

        // showing route : separate by admin and client
        Route::get('/admin/{user}', 'show')
          ->can('view', 'user')
          ->name('admin.show');
        Route::get('/client/{user}', 'show')
          ->name('client.show');

        // can edit only the admin but not themself or client 
        Route::get('/{user}/edit', 'edit')
          ->name('edit');
        Route::patch('/{user}', 'update')
          ->can('update', 'user')
          ->name('admin.update');

        // delete (terminate only admin)
        Route::delete('/{user}', 'destroy')
          ->name('admin.destroy');
        Route::patch('/{user}/restore', 'restore')
          ->name('admin.restore');
      });

    // Reports
    Route::controller(AdminReportController::class)
      ->prefix('report')
      ->name('report.')
      ->group(function () {
        Route::get('/', 'index')
          ->name('index');
        Route::get('/sales', 'sales')
          ->name('sales');
        Route::get('/category', 'category')
          ->name('category');
        Route::get('/orders', 'order')
          ->name('order');
        Route::get('/products', 'product')
          ->name('product');
        Route::get('/customer', 'customer')
          ->name('customer');
      });
  });
