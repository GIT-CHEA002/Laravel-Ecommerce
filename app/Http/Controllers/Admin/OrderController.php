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
            ->when($request->filled('payment_status'), fn($query) => $query->where('payment_status', $request->payment_status))
            ->when($request->filled('period'), function ($query) use ($request) {
                $now = now();
                match ($request->period) {
                    'this_month' => $query->whereBetween('created_at', [
                        $now->copy()->startOfMonth(),
                        $now->copy()->endOfMonth(),
                    ]),
                    'last_month' => $query->whereBetween('created_at', [
                        $now->copy()->subMonthNoOverflow()->startOfMonth(),
                        $now->copy()->subMonthNoOverflow()->endOfMonth()
                    ]),
                    'last_7_days' => $query->where('created_at', '>=', $now->copy()->subDays(7)->startOfDay()),
                    'custom' => $query
                        ->when($request->filled('date_from'), fn($q) => $q->whereDate('created_at', '>=', $request->date_from))
                        ->when($request->filled('date_to'), fn($q) => $q->whereDate('created_at', '<=', $request->date_to)),
                    default => null,
                };
            })
            ->simplePaginate(10)
            ->withQueryString();

        // summaryInfo 
        $totalRevenue = Order::thisMonthRevenue();
        $shippingOrder = Order::where('status', 'pending')->count();
        $deliveredOrder = Order::where('status', 'delivered')->count();
        $cancelOrder = Order::where('status', 'cancelled')->count();

        $summaryInfo = [
            [
                'title' => 'Total Revenue',
                'value' => '$ ' . number_format($totalRevenue, 2),
                'icon' => 'banknotes',
                'change' => '+14.2% vs last month',
                'trend' => 'up',
            ],
            [
                'title' => 'Awaiting Shipment',
                'value' => $shippingOrder . ' Orders',
                'icon' => 'truck',
                'change' => 'Requires immediate action',
                'trend' => 'neutral',
            ],
            [
                'title' => 'Delivered (30D)',
                'value' => $deliveredOrder . " Orders",
                'icon' => 'check-circle',
                'change' => '98.2% on-time rate',
                'trend' => 'up',
            ],
            [
                'title' => 'Cancelled / Refunded',
                'value' =>  $cancelOrder . ' Orders',
                'icon' => 'x-circle',
                'change' => '1.6% cancellation rate',
                'trend' => 'down',
            ],
        ];
        $status = Order::query()
            ->select('status')
            ->distinct()
            ->orderBy('status')
            ->pluck('status')
            ->mapWithKeys(fn($s) => [$s => ucfirst($s)])
            ->toArray();
        return view('admin.orders.index', ['orders' => $orders, 'summaryInfo' => $summaryInfo, 'status' => $status]);
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
