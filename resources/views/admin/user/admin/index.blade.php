@php
  $breadcrumpLink = [
    ['label' => 'Users', 'url' => route('admin.user.index')],
    ['label' => 'Admin'],
  ];  
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - User Admin')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  <x-shared.breadcrumb :items="$breadcrumpLink" />
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.section-header>Admin User</x-shared.section-header>
      <x-shared.intro-text>Manage Admin log in , track fullfillment status, and monitor revenue.</x-shared.intro-text>
    </div>
    @can('create', App\Models\User::class)
      <x-button.primary-button href="{{ route('admin.user.create') }}">Create New Admin</x-button.primary-button>
    @endcan
  </div>
  <x-form.form method="GET" action="{{ route('admin.user.admin') }}" onchange="this.submit()"
    class="flex justify-between items-center bg-white dark:bg-slate-800 p-3 rounded-md shadow-md mt-3">
    <div class="w-1/4">
      <x-form.field name="search" placeholder="Jonh-Doe / johndoe@gmail.com" :value="request('search')"
        class="py-1 tracking-wide space-y-0 placeholder:capitalize" icon="magnifying-glass" />
    </div>
    {{-- filter section --}}
    <div class="flex justify-end items-center gap-4">
      <x-form.select name="status" placeholder="All status" :selected="request('status')" :options="[1 => 'Active', 0 => 'Inactive']" />
      <x-form.select name="sort" placeholder="Sort by (Default)" :options="[
      'first_name' => 'Sort by: First Name',
      'last_name' => 'Sort by: Last Name',
      'email' => 'Sort by: Email',
      'created_at' => 'Sort by: Date Registered',
    ]"
        :selected="request('sort')" />
      <x-form.select name="direction" placeholder="Order(Default)" :options="['asc' => 'Order: Ascending', 'desc' => 'Order: Descending']" :selected="request('direction')" />
    </div>
  </x-form.form>
  {{-- Display table --}}
  <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit my-3 overflow-hidden">
    <table class="w-full text-sm text-left dark:text-white">
      <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
        <tr class="font-light">
          @foreach (['ID', 'Avatar', 'Customer Name', 'Email', 'Registe On', 'Status', 'Action'] as $heading)
            <th class="px-3 py-3">{{ $heading }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody class="divide-y">
        @foreach ($admins as $admin)
          <tr>
            <td class="px-3 py-2">
              {{ $admin->user_id }}
            </td>
            <td class="px-3 py-2">
              <div class="w-10 h-10 rounded-md overflow-hidden">
                <img src="{{ $admin->avatar ?: 'https://placehold.co/200x300?text=No+Image' }}"
                  alt="{{ $admin->first_name }}" class="object-cover w-full h-full">
              </div>
            </td>
            <td class="px-3 py-2">{{ $admin->first_name  }}-{{ $admin->last_name }}</td>
            <td class="px-3 py-2">
              {{ $admin->email }}
            </td>
            <td class="px-3 py-2">
              {{ $admin->created_at->format('D d M Y') }}
            </td>

            <td class="px-3 py-2">
              @if ($admin->is_active == true)
                <x-shared.badge-tag>Active</x-shared.badge-tag>
              @else
                <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">Inactive</x-shared.badge-tag>
              @endif
            </td>
            <td class="px-3 py-2  ">
              <div class="flex justify-start items-center gap-3">
                <a href="{{ route('admin.user.admin.show', $admin) }}">
                  <x-heroicon-o-eye class="w-4 h-5 text-indigo-700 dark:text-indigo-500" />
                </a>
                <a href="{{ route('admin.user.edit', $admin) }}">
                  <x-heroicon-o-pencil class="w-4 h-5 text-yellow-700 dark:text-yellow-500" />
                </a>
                @if ($admin->is_active == true)
                  @can('delete', $admin)
                    <div x-data="{isDeleteOpen : false}">
                      <button type="button" @click="isDeleteOpen = true" class="cursor-pointer">
                        <x-heroicon-o-trash class="w-4 h-5 text-red-700 dark:text-red-500" />
                      </button>
                      <x-shared.confirm-dialog show="isDeleteOpen" title="Deactivate Admin"
                        message="Are you sure want to deactivate this admin user ?"
                        action="{{ route('admin.user.admin.destroy', $admin) }}" confirmText="Deactivate" />
                    </div>
                  @endcan
                @elseif ($admin->is_active == false)
                  @can('restore', $admin)
                    <div x-data="{isRestoreOpen : false}">
                      <button type="button" @click="isRestoreOpen = true" class="cursor-pointer">
                        <x-heroicon-s-arrow-uturn-left class="w-4 h-5 text-green-700 dark:text-green-500" />
                      </button>
                      <x-shared.confirm-dialog show="isRestoreOpen" title="Restore Product"
                        confirmStyle="bg-green-700 dark:bg-green-500" message="Are you sure want to restore this product"
                        method="PATCH" action="{{ route('admin.user.admin.restore', $admin) }}" confirmText="Restore" />
                    </div>
                  @endcan
                @endif
              </div>

            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="px-3 py-3 text-right flex justify-end items-center gap-1 border-t">
      <x-heroicon-o-arrow-left class="w-3 h-3 text-indigo-700 dark:text-indigo-500" />
      <a href="{{ route('admin.user.index') }}"
        class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-700 dark:text-indigo-500 origin-right transition-transform duration-300 hover:scale-105">
        Back
      </a>
    </div>
  </div>
  <div class="py-2 ">
    {{ $admins->links() }}
  </div>
@endsection