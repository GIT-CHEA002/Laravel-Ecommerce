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
  private function compare(float|int $current, float|int $previous, string $label): array
  {
    if ($previous == 0) {
      return $current > 0
        ? ['change' => "New activity $label", 'trend' => 'up']
        : ['change' => "No change $label", 'trend' => 'neutral'];
    }

    $percent = (($current - $previous) / $previous) * 100;

    if (round($percent, 1) == 0) {
      return ['change' => "0% $label", 'trend' => 'neutral'];
    }

    return [
      'change' => sprintf('%+.1f%% %s', $percent, $label),
      'trend' => $percent > 0 ? 'up' : 'down',
    ];
  }
  public function index()
  {
    // periods 
    $thisMonthStart = now()->startOfMonth();
    $lastMonthStart = now()->subMonthNoOverflow()->startOfMonth();
    $lastMonthEnd = $lastMonthStart->copy()->endOfMonth();

    // old data 
    $thisMonthRevenue = Order::thisMonthRevenue();
    $lastMonthRevenue = Order::lastMonthRevenue();
    $totalOrder = Order::count();
    $totalCustomer = User::where('role_id', 2)->count();
    $totalProduct = Product::count();
    $totalCategoryWithProduct = Category::has('products')->count();
    $totalCategoryWithoutProduct = Category::doesntHave('products')->count();

    // periods compare 
    $monthBeforeLastRevenue = Order::monthBeforeLastRevenue();

    $orderThisMonth = Order::where('created_at', '>=', $thisMonthStart)->count();
    $orderLastMonth = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

    $summaryInfo = [
      [
        'title' => 'Total Revenue This Month',
        'value' => '$ ' . number_format($thisMonthRevenue, 2),
        'icon' => 'banknotes',
        ...$this->compare($thisMonthRevenue, $lastMonthRevenue, 'vs last month'),
      ],
      [
        'title' => 'Total Revenue last month',
        'value' => '$ ' . number_format($lastMonthRevenue, 2),
        'icon' => 'banknotes',
        ...$this->compare($lastMonthRevenue, $monthBeforeLastRevenue, 'vs month before'),
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
