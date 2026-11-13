@php
  $breadcrumpLink = [
    ['label' => 'Users', 'url' => route('admin.user.index')],
    ['label' => 'Admin', 'url' => route('admin.user.admin')],
    ['label' => 'Create-Admin'],
  ];

@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - User Create Form(Admin)')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  <div class="flex justify-between items-center">
    <x-shared.breadcrumb :items="$breadcrumpLink" />
    <x-button.primary-button href="{{ route('admin.user.admin') }}">Cancel</x-button.primary-button>
  </div>
  <x-form.form method="POST" action="{{ route('admin.user.store') }}">
    <div class="grid grid-cols-3 gap-6 py-4 mt-3 border-t auto-rows-auto">
      <div class="col-span-2 space-y-4">
        <div class="bg-white dark:bg-slate-800 rounded-md shadow-md p-4 h-fit">
          <div class="py-3 border-b flex justify-between items-center">
            <x-shared.section-header class="flex items-center">
              <x-heroicon-s-pencil-square class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
              <span>Personal and Contact Information</span>
            </x-shared.section-header>
            <span class="text-xs tracking-wide">*Required Fields</span>
          </div>

          <div class="py-2 flex justify-between gap-3">
            <x-form.field label="First Name" name="first_name" value="{{ old('first_name') }}" placeholder="e.g. Sokha"
              class="flex-1" />
            <x-form.field label="Last Name" name="last_name" value="{{ old('last_name') }}" placeholder="e.g. Chan"
              class="flex-1" />
          </div>

          <div class="py-2 flex items-center justify-between gap-3">
            <x-form.field label="Phone Number" name="phone" value="{{ old('phone') }}" placeholder="e.g. 012 345 678"
              class="flex-1" />
            <x-form.field label="Email Address" name="email" value="{{ old('email') }}"
              placeholder="e.g. sokha.chan@example.com" class="flex-1" />
          </div>
          <x-form.field label="Password (8 or more characters)" name="password" type="password"
            placeholder="Enter at least 8 characters" autocomplete="new-password" class="flex-1" />
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-md shadow-md p-4 h-fit">
          <div class="py-3 border-b flex justify-between items-center">
            <x-shared.section-header class="flex items-center">
              <x-heroicon-s-map-pin class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
              <span>Address and Location</span>
            </x-shared.section-header>
            <span class="text-xs tracking-wide">*Required Fields</span>
          </div>

          <div class="space-y-4">
            <x-form.field label="Address Line" name="user_addresses[address_line]"
              value="{{ old('user_addresses.address_line') }}" placeholder="e.g. #123, Street 271, Sangkat Tuek Thla" />
            <div class="flex gap-3 justify-between items-center">
              <x-form.field label="City" name="user_addresses[city]" value="{{ old('user_addresses.city') }}"
                placeholder="e.g. Phnom Penh" class="flex-1" />
              <x-form.field label="Postal Code" name="user_addresses[postal_code]"
                value="{{ old('user_addresses.postal_code') }}" placeholder="e.g. 12000" class="flex-1" />
            </div>
            <div class="flex justify-start items-center gap-6">
              <x-form.checkbox name="user_addresses[is_default]" value="1" :checked="(bool) old('user_addresses.is_default')" label="Set as Default Address" />
              <x-form.checkbox name="is_active" value="1" :checked="(bool) old('is_active')" label="Is Active ? " />
            </div>

          </div>
        </div>
      </div>

      <div class="col-span-1 space-y-4">
        {{-- preview and image --}}
        <div class="p-4 shadow-md bg-white dark:bg-slate-800 rounded-md">
          <div class="py-3 border-b">
            <x-shared.section-header class="flex items-center">
              <x-heroicon-s-photo class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
              <span>Preview and Image</span>
            </x-shared.section-header>
          </div>
          <div class="py-2 space-y-4">
            <img src="{{ 'https://placehold.co/200x300?text=No+Image' }}" alt="Avatar"
              class="object-cover w-full h-[200px] rounded">
          </div>
          <x-form.field label="Avatar (accepted url only)" name="avatar" value="{{ old('avatar') }}"
            placeholder="e.g. https://example.com/photo.jpg" />
        </div>
        <div class="py-4">
          <x-form.button type="submit" class="capitalize">Create this new Admin </x-form.button>
        </div>
      </div>
    </div>
  </x-form.form>

@endsection