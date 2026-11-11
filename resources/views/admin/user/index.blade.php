@php
  $summaryInfo = [
    [
      'title' => 'Total Clients',
      'value' => $clientCount . ' ' . Str::plural('client', $clientCount),
      'icon' => 'users',
      'change' => '+14.2% vs last month',
      'trend' => 'up',
      'target' => route('admin.user.client')
    ],
    [
      'title' => 'Total Admin Users',
      'value' => $adminCount . ' ' . Str::plural('admin', $adminCount),
      'icon' => 'shield-check',
      'change' => 'No change vs last month',
      'trend' => 'neutral',
      'target' => route('admin.user.admin')
    ],
    [
      'title' => 'Newest Registrations',
      'value' => $clients->count() . ' new ' . Str::plural('user', $clients->count()),
      'icon' => 'user-plus',
      'change' => 'Registered this month',
      'trend' => 'up',

    ],
  ];
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - User Orders')
@section('page-heading', 'Total Orders')
@section('content')
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.section-header>Customer</x-shared.section-header>
      <x-shared.intro-text>Manage customer, track fullfillment status, and monitor revenue.</x-shared.intro-text>
    </div>
  </div>
  <div class="grid grid-cols-4 auto-rows-auto gap-4 py-4 ">
    @foreach ($summaryInfo as $info)
      @if (!empty($info['target']))
        <a href="{{ $info['target'] }}">
          @include('admin.orders.order-summary-card', ['info' => $info])
        </a>
      @else
        @include('admin.orders.order-summary-card', ['info' => $info])
      @endif
    @endforeach
  </div>
  <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit my-3 overflow-hidden">
    <table class="w-full text-sm text-left dark:text-white">
      <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
        <tr class="font-light">
          @foreach (['ID', 'Avatar', 'Customer Name', 'Email', 'Status', 'Action'] as $heading)
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
            <td class="px-3 py-2">${{ $client->email }}</td>
            <td class="px-3 py-2">
              @php
                $badge = match ($client->is_active) {
                  0 => ['bg-red-100', 'text-red-600'],
                  1 => ['bg-green-100', 'text-green-600'],
                };
              @endphp
              <x-shared.badge-tag :bgColor="$badge[0]" :textColor="$badge[1]">
                {{ ucfirst($client->is_active == 1 ? 'Active' : "Inactive") }}
              </x-shared.badge-tag>
            </td>
            <td class="px-3 py-2">
              <a href="{{ route('admin.user.show', $client) }}"
                class="text-xs font-semibold tracking-wide text-indigo-700 dark:text-indigo-500 hover:underline underline-offset-2">view</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="px-3 py-3 text-right flex justify-end items-center gap-1 border-t">

      <a href="{{ route('admin.user.client') }}"
        class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-700 dark:text-indigo-500 origin-right transition-transform duration-300 hover:scale-105">
        View All
      </a>
      <x-heroicon-o-arrow-right class="w-3 h-3 text-indigo-700 dark:text-indigo-500" />
    </div>
  </div>
@endsection