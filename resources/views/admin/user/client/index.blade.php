{{-- @php
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
@endphp --}}
@extends('layout.admin-layout')
@section('title', 'Admin - User Admin')
@section('content')
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.section-header>Admin User</x-shared.section-header>
      <x-shared.intro-text>Manage admin log in , track fullfillment status, and monitor revenue.</x-shared.intro-text>
    </div>
  </div>
  {{-- <div class="grid grid-cols-4 auto-rows-auto gap-4 py-4 ">
    @foreach ($summaryInfo as $info)
    @include('admin.orders.order-summary-card', ['info' => $info])
    @endforeach
  </div> --}}

  <x-form.form method="GET" action="{{ route('admin.user.client') }}" onchange="this.submit()"
    class="flex justify-between items-center bg-white dark:bg-slate-800 p-3 rounded-md shadow-md mt-3">
    <div class="w-1/4">
      <x-form.field name="search" placeholder="001... / johndoe@gmail.com" :value="request('search')"
        class="py-1 tracking-wide space-y-0 placeholder:capitalize" icon="magnifying-glass" />
    </div>
    {{-- filter section --}}
    <div class="flex justify-end items-center gap-4">
      <x-form.select name="status" placeholder="All status" :selected="request('status')" :options="[1 => 'Active', 0 => 'Inactive']" />
      <x-form.select name="sort" placeholder="Sort By" :options="['first_name' => 'First Name', 'last_name' => 'Last Name']"
        :selected="request('sort')" />
      <x-form.select name="direction" placeholder="Order" :options="['asc' => 'Ascending', 'desc' => 'Descending']"
        :selected="request('direction')" />
    </div>
  </x-form.form>
  {{-- Display table --}}
  <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit my-3 overflow-hidden">
    <table class="w-full text-sm text-left dark:text-white">
      <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
        <tr class="font-light">
          @foreach (['ID', 'Image', 'Customer Name', 'Email', 'Registe On', 'Status', 'Action'] as $heading)
            <th class="px-3 py-3">{{ $heading }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody class="divide-y">
        @foreach ($clients as $client)
          <tr>
            <td class="px-3 py-2">
              {{ $client->user_id }}
            </td>
            <td class="px-3 py-2">
              <div class="w-10 h-10 rounded-md overflow-hidden">
                <img src="{{ $client->avatar ?? 'https://picsum.photos/200/300' }}" alt="{{ $client->first_name }}"
                  class="object-cover w-full h-full">
              </div>
            </td>
            <td class="px-3 py-2">{{ $client->first_name  }}-{{ $client->last_name }}</td>
            {{-- <td class="px-3 py-2">{{ $order->status}}</td> --}}
            <td class="px-3 py-2">
              {{ $client->email }}
            </td>
            <td class="px-3 py-2">
              {{ $client->created_at->format('D d M Y') }}
            </td>

            <td class="px-3 py-2">
              @if ($client->is_active == true)
                <x-shared.badge-tag>Active</x-shared.badge-tag>
              @else
                <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">Inactive</x-shared.badge-tag>
              @endif
            </td>


            <td class="px-3 py-2">
              <a href="{{ route('admin.users.show', $client) }}"
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
                    confirmStyle="bg-green-700 dark:bg-green-500" message="Are you sure want to restore this product"
                    method="PATCH" action="{{ route('admin.products.restore', $product) }}" confirmText="Restore" />
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
  <div class="py-2 ">
    {{ $clients->links() }}
  </div>
  {{-- <div class="py-2">
    {{ $orders->links() }}
  </div> --}}

@endsection