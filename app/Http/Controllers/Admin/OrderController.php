<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        $order = Order::all();
        return $order;
    }
    public function show(Order $order)
    {
        dd(Order::findOrFail($order->order_id));
    }
    public function create()
    {
        dd("Create category form");
    }
    public function store(Request $request)
    {
        dd("Store the category");
    }
    public function edit()
    {
        dd("Edit the category form");
    }
    public function update(Request $request)
    {
        dd("To do update list");
    }
    public function destroy(Request $request)
    {
        dd("Destroy the category items");
    }
}
