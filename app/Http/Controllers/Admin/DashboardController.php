<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  //
  public function index()
  {
    $thisMonthRevenue = Order::thisMonthRevenue();
    $lastMonthRevenue = Order::lastMonthRevenue();
    $totalOrder = Order::count();
    $totalCustomer = User::where('role_id', 2)->count();
    $totalProduct = Product::count();
    $totalCategoryWithProduct = Category::with('product')->count();
    $totalCategoryWithoutProduct = Category::without('product')->count();
    $summaryInfo = [
      [
        'title' => 'Total Revenue This Month',
        'value' => '$ ' . number_format($thisMonthRevenue, 2),
        'icon' => 'banknotes',
        'change' => '+12.5% from last month',
        'trend' => 'up',
      ],
      [
        'title' => 'Total Revenue last month',
        'value' => '$ ' . number_format($lastMonthRevenue, 2),
        'icon' => 'banknotes',
        'change' => '+12.5% from last month',
        'trend' => 'up',
      ],
      [
        'title' => 'Orders',
        'value' => $totalOrder . ' Order',
        'icon' => 'shopping-cart',
        'change' => '+5.2% from last month',
        'trend' => 'up',
      ],
      [
        'title' => 'Customers',
        'value' => $totalCustomer . ' customer',
        'icon' => 'users',
        'change' => '+18.1% from last month',
        'trend' => 'up',
      ],
      [
        'title' => 'Products',
        'value' => $totalProduct . ' product',
        'icon' => 'archive-box',
        'change' => 'Steady inventory',
        'trend' => 'neutral',
      ],
      [
        'title' => 'Category with product',
        'value' => $totalCategoryWithProduct . ' category',
        'icon' => 'rectangle-group',
        'change' => '2 new added',
        'trend' => 'neutral',
      ],
      [
        'title' => 'Category without product',
        'value' => $totalCategoryWithoutProduct . ' category',
        'icon' => 'rectangle-group',
        'change' => '2 new added',
        'trend' => 'neutral',
      ],
    ];

    $recentOrder = Order::with('user')->latest()->take(5)->get();
    $lowStockProduct = Product::where('stock_quantity', '<=', 10)->get();
    $newRegister = User::where('role_id', 2)->latest()->take(5)->get();
    return view(
      'admin.dashboard.dashboard',
      [
        'summaryInfo' => $summaryInfo,
        'recentOrder' => $recentOrder,
        'lowStockProduct' => $lowStockProduct,
        'newRegister' => $newRegister
      ]
    );
  }
}
