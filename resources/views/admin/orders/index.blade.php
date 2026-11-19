@extends('layout.admin-layout')
@section('title', 'Admin - User Orders')
@section('page-heading', 'Total Orders')
@section('content')
    <div class="flex justify-between items-center">
        <div class="block">
            <x-shared.section-header>Orders</x-shared.section-header>
            <x-shared.intro-text>Manage customers, track fulfillment status, and monitor revenue.</x-shared.intro-text>
        </div>
    </div>
    {{-- Summary cards --}}
    <div class="grid grid-cols-4 auto-rows-auto gap-4 py-4">
        @foreach ($summaryInfo as $info)
            @include('admin.orders.order-summary-card', ['info' => $info])
        @endforeach
    </div>
    {{-- Search and filters --}}
    <x-form.form action="{{ route('admin.orders.index') }}"
        class="flex justify-between items-center bg-white dark:bg-slate-800 p-3 rounded-md shadow-md mt-3">
        <div class="w-1/4">
            <x-form.field name="order_number" placeholder="ORD-001..." icon="magnifying-glass"
                :value="request('order_number')" class="py-1 tracking-wide space-y-0 placeholder:capitalize" />
        </div>
        <div class="flex justify-end items-center gap-4">
            {{-- Period filter with custom date range popup --}}
            <div class="relative" x-data="{
                                                                     period: '{{ request('period') }}',
                                                                     saved: '{{ request('period') }}',
                                                                     open: false,
                                                                     pick() {
                                                                        if (this.period === 'custom') {
                                                                            this.open = true;
                                                                        } else {
                                                                          this.$root.closest('form').submit();
                                                                        }
                                                                        },
                                                                         cancel() {
                                                                        this.period = this.saved;
                                                                        this.open = false;
                                                                        }
                                                                       }">

                <x-form.select name="period" placeholder="All time" x-model="period" x-on:change="pick()"
                    :selected="request('period')" :options="[
            'this_month' => 'This month',
            'last_month' => 'Last month',
            'last_7_days' => 'Last 7 days',
            'custom' => 'Custom',
        ]" />
                <div x-show="open" x-cloak x-transition x-on:click.outside="cancel()" x-on:keydown.escape.window="cancel()"
                    class="absolute right-0 top-full mt-2 z-50 w-72 p-4 space-y-3 bg-white dark:bg-slate-800 rounded-md shadow-xl border border-slate-200 dark:border-slate-700">

                    <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Custom date range
                    </h4>
                    <div class="space-y-2">
                        <label class="block text-xs text-slate-500 dark:text-slate-400">From</label>
                        <x-form.field type="date" name="date_from" :value="request('date_from')" />
                        <label class="block text-xs text-slate-500 dark:text-slate-400">To</label>
                        <x-form.field type="date" name="date_to" :value="request('date_to')" />
                    </div>

                    <div class="flex justify-end gap-2 pt-1">
                        <button type="button" x-on:click="cancel()"
                            class="px-3 py-1 text-sm rounded-md text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                            Cancel
                        </button>
                        <button type="submit" class="px-3 py-1 text-sm rounded-md bg-blue-600 text-white hover:bg-blue-700">
                            Apply
                        </button>
                    </div>
                </div>
            </div>

            <x-form.select name="status" placeholder="All status" onchange="this.form.submit()"
                :selected="request('status')" :options="$status" />

            <x-form.select name="payment_status" placeholder="Paid / Unpaid" onchange="this.form.submit()"
                :selected="request('payment_status')" :options="['paid' => 'Paid', 'unpaid' => 'Unpaid']" />
        </div>
    </x-form.form>

    {{-- Orders table --}}
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
                    @php
                        $badge = match ($order->status) {
                            'pending' => ['bg-red-100', 'text-red-600'],
                            'processing' => ['bg-blue-100', 'text-blue-600'],
                            'shipping' => ['bg-amber-100', 'text-amber-600'],
                            'delivered' => ['bg-green-100', 'text-green-600'],
                            'cancelled' => ['bg-gray-100', 'text-gray-600'],
                            'refunded' => ['bg-purple-100', 'text-purple-600'],
                            default => ['bg-gray-100', 'text-gray-500'],
                        };
                    @endphp
                    <tr>
                        <td class="px-3 py-2">{{ $order->order_id }}</td>
                        <td class="px-3 py-2">
                            {{ $order->user?->first_name }}-{{ $order->user?->last_name }}
                        </td>
                        <td class="px-3 py-2">${{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-3 py-2">
                            <x-shared.badge-tag :bgColor="$badge[0]" :textColor="$badge[1]">
                                {{ ucfirst($order->status ?? 'unknown') }}
                            </x-shared.badge-tag>
                        </td>
                        <td class="px-3 py-2">{{ $order->shipping_address }}</td>
                        <td class="px-3 py-2">
                            <span class="text-xs font-medium capitalize tracking-wide text-indigo-700 dark:text-indigo-500">
                                {{ $order->payment_status }}
                            </span>
                        </td>
                        <td class="px-3 py-2 flex justify-center">
                            <a href="{{ route('admin.orders.show', $order) }}"
                                class="text-xs tracking-wide text-indigo-700 dark:text-indigo-500 hover:underline underline-offset-2">
                                <x-heroicon-o-eye class="w-4 h-5 text-indigo-700 dark:text-indigo-500" />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="py-2">
        {{ $orders->links() }}
    </div>
@endsection