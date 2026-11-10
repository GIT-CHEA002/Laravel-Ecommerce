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

    //     $summaryInfo = [
    //   [
    //     'title' => 'Total Revenue',
    //     'value' => '$124,563.00',
    //     'icon' => 'banknotes',
    //     'change' => '+12.5% from last month',
    //     'trend' => 'up',
    //   ],
    //   [
    //     'title' => 'Orders',
    //     'value' => '1,245',
    //     'icon' => 'shopping-cart',
    //     'change' => '+5.2% from last month',
    //     'trend' => 'up',
    //   ],
    //   [
    //     'title' => 'Customers',
    //     'value' => '8,932',
    //     'icon' => 'users',
    //     'change' => '+18.1% from last month',
    //     'trend' => 'up',
    //   ],
    //   [
    //     'title' => 'Products',
    //     'value' => '456',
    //     'icon' => 'archive-box',
    //     'change' => 'Steady inventory',
    //     'trend' => 'neutral',
    //   ],
    //   [
    //     'title' => 'Category',
    //     'value' => '24',
    //     'icon' => 'rectangle-group',
    //     'change' => '2 new added',
    //     'trend' => 'neutral',
    //   ],
    // ];
    // get some order information products
    // summaryInfoDashboard 
    $totaRevenue = 124563;
    $totalOrderCount = Order::count();
    $totalCustomerCount = User::count('role_id');
    $totalProductCount = Product::count();
    $totalCategoryWithProductCount = Category::with('product')->count();
    $totalCategoryWithoutProductCount = Category::without('product')->count();



    return view('admin.dashboard.dashboard', ['Data' => 'Hello Dashboard data']);
  }
}
