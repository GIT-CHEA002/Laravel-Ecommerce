@php
    $summaryInfo = [
        [
            'title' => 'Total Revenue',
            'value' => '$48,295.50',
            'icon' => 'banknotes',
            'change' => '+14.2% vs last month',
            'trend' => 'up',
        ],
        [
            'title' => 'Awaiting Shipment',
            'value' => '18',
            'icon' => 'truck',
            'change' => 'Requires immediate action',
            'trend' => 'neutral',
        ],
        [
            'title' => 'Delivered (30D)',
            'value' => '116',
            'icon' => 'check-circle',
            'change' => '98.2% on-time rate',
            'trend' => 'up',
        ],
        [
            'title' => 'Cancelled / Refunded',
            'value' => '8',
            'icon' => 'x-circle',
            'change' => '1.6% cancellation rate',
            'trend' => 'down',
        ],
    ];
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - User Orders')
@section('page-heading', 'Total Orders')
@section('content')
    <div class="flex justify-between items-center">
        <div class="block">
            <x-shared.section-header>Orders</x-shared.section-header>
            <x-shared.intro-text>Manage customer, track fullfillment status, and monitor revenue.</x-shared.intro-text>
        </div>
    </div>
    {{-- summary card --}}
    <div class="grid grid-cols-4 auto-rows-auto gap-4 py-4 ">
        @foreach ($summaryInfo as $info)
            @include('admin.orders.order-summary-card', ['info' => $info])
        @endforeach
    </div>
    {{-- search and filter section --}}

    <x-form.form method="GET" action="{{ route('admin.orders.index') }}" onchange="this.submit()"
        class="flex justify-between items-center bg-white dark:bg-slate-800 p-3 rounded-md shadow-md mt-3">
        <div class="w-1/4">
            <x-form.field name="order_number" placeholder="ORD-001..." :value="request('order_number')"
                class="py-1 tracking-wide space-y-0 placeholder:capitalize" icon="magnifying-glass" />
        </div>
        {{-- filter section --}}
        <div class="flex justify-end items-center gap-4">
            <x-form.select name="status" placeholder="All status" :selected="request('status')" :options="['shipping' => 'Shipping', 'arrived' => 'Arrived', 'pending' => 'Pending']" onchange="this.form.submit()" />
            <x-form.select name="is_paid" placeholder="All Statuses" :options="[1 => 'Paid', 0 => 'Unpaid']"
                onchange="this.form.submit()" :selected="request('is_paid')" />
        </div>
    </x-form.form>


    {{-- Display table --}}
    <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit my-3 overflow-hidden">
        <table class="w-full text-sm text-left dark:text-white">
            <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
                <tr class="font-light">
                    @foreach (['ID', 'Customer Name', 'Total', 'Status', 'Shipping Address', 'Is Paid', 'Action'] as $heading)
                        <th class="px-3 py-3">{{ $heading }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($orders as $order)
                    <tr>
                        <td class="px-3 py-2">
                            {{ $order->order_id }}
                        </td>
                        <td class="px-3 py-2">{{ $order->user?->first_name  }}-{{ $order->user->last_name }}</td>
                        <td class="px-3 py-2">${{ number_format($order->total_amount, 2) }}</td>
                        {{-- <td class="px-3 py-2">{{ $order->status}}</td> --}}
                        <td class="px-3 py-2">

                            @if ($order->status == 'shipping')
                                <x-shared.badge-tag bgColor="bg-amber-100" textColor="text-amber-600">
                                    {{ $order->status }}
                                </x-shared.badge-tag>
                            @elseif ($order->status == 'pending')
                                <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">
                                    {{ $order->status }}
                                </x-shared.badge-tag>
                            @elseif ($order->status == 'arrived')
                                <x-shared.badge-tag bgColor="bg-green-100" textColor="text-green-600">
                                    Not Available
                                </x-shared.badge-tag>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            {{ $order->shipping_address }}
                        </td>
                        <td class="px-3 py-2">
                            {{ $order->is_paid ? 'Paid' : 'Not yet' }}
                        </td>
                        <td class="px-3 py-2">
                            <a href="{{ route('admin.orders.show', $order) }}"
                                class="text-xs tracking-wide text-indigo-700 dark:text-indigo-500 hover:underline underline-offset-2">view</a>
                        </td>
                        {{-- <td class="px-3 py-2">
                            <div class="flex justify-start items-center gap-3">
                                <a href="{{ route('admin.products.show', $product) }}">
                                    <x-heroicon-o-eye class="w-4 h-5 text-indigo-700 dark:text-indigo-500" />
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}">
                                    <x-heroicon-o-pencil class="w-4 h-5 text-yellow-700 dark:text-yellow-500" />
                                </a>
                                @if ($product->is_on_market == true)
                                @can('delete', $product)
                                <div x-data="{isDeleteOpen : false}">
                                    <button type="button" @click="isDeleteOpen = true" class="cursor-pointer">
                                        <x-heroicon-o-trash class="w-4 h-5 text-red-700 dark:text-red-500" />
                                    </button>
                                    <x-shared.confirm-dialog show="isDeleteOpen" title="Deactivate Product"
                                        message="Are you sure want to deactivate this product"
                                        action="{{ route('admin.products.destroy', $product) }}" confirmText="Deactivate" />
                                </div>
                                @endcan
                                @elseif ($product->is_on_market == false)
                                @can('restore', $product)
                                <div x-data="{isRestoreOpen : false}">
                                    <button type="button" @click="isRestoreOpen = true" class="cursor-pointer">
                                        <x-heroicon-s-arrow-uturn-left class="w-4 h-5 text-green-700 dark:text-green-500" />
                                    </button>
                                    <x-shared.confirm-dialog show="isRestoreOpen" title="Restore Product"
                                        confirmStyle="bg-green-700 dark:bg-green-500"
                                        message="Are you sure want to restore this product" method="PATCH"
                                        action="{{ route('admin.products.restore', $product) }}" confirmText="Restore" />
                                </div>
                                @endcan
                                @endif
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="py-2">
        {{ $orders->links() }}
    </div>

@endsection