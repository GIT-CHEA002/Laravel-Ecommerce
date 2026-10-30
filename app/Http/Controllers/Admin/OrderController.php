<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $orders = Order::with('user')
            ->when($request->filled('order_number'), fn($query) => $query->whereLike('order_number', '%' . trim($request->order_number) . '%'))
            ->when($request->filled('status'), fn($query) => $query->where('status', $request->status))
            ->when($request->filled('is_paid'), fn($query) => $query->where('is_paid', $request->is_paid))
            ->simplePaginate(10);
        return view('admin.orders.index', ['orders' => $orders]);
    }
    public function show(Order $order)
    {
        $order->load('orderProduct.products')->simplePaginate(5);
        return view('admin.orders.show', ['order' => $order]);
    }
    public function destroy(Request $request)
    {
        dd("soft delete the  the order items");
    }
    public function forceDelete(Request $request)
    {
        dd('Force Delete the order');
    }
}
