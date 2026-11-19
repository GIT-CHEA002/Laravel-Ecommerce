@php
  $breadcrumpLink = [
    ['label' => 'Profile', 'url' => route('admin.profile.index')],
    ['label' => 'Reset-Password']
  ];

@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - Reset Password')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  <x-shared.breadcrumb :items="$breadcrumpLink" />
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.section-header>Reset Password Form </x-shared.section-header>
      <x-shared.intro-text class=" capitalize">update on :
        {{ auth()->user()->updated_at->format('l d F Y') }}</x-shared.intro-text>
    </div>
  </div>
  <h1 class="py-4 opacity-0"></h1>
  <div class="grid grid-cols-3 gap-6 auto-rows-auto">
    <div class=" col-span-2 bg-white dark:bg-slate-800 rounded-md shadow-md p-4 h-fit">
      <div class="py-3 border-b flex justify-between items-center">
        <x-shared.section-header class="flex items-center">
          <x-heroicon-s-map-pin class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
          <span>Security Settings</span>
        </x-shared.section-header>
      </div>
      <x-form.form method="POST" action="{{ route('auth.password.update') }}">
        @csrf
        @method('PUT')
        <div class="space-y-4 mt-2">
          <x-form.field label="Old Password" name="old_password" type="password" value="{{ old('old_password') }}"
            placeholder="e.g. Sokchea007" />
          <x-form.field label="New Password" name="new_password" type="password" value="{{ old('new_password') }}"
            placeholder="e.g. Sokchea007" />
          <x-form.field label="Confirm New Password" name="new_password_confirmation" type="password"
            value="{{ old('new_password_confirmation') }}" placeholder="e.g. Sokchea007" />
          <div class="flex justify-end items-center gap-6">
            <span>
              <x-button.primary-button href="{{ route('admin.profile.index') }}"
                class=" uppercase">Back</x-button.primary-button>
            </span>
            <span>
              <x-form.button type="submit" class="w-fit rounded-md">Reset password</x-form.button>
            </span>
          </div>

        </div>
      </x-form.form>
    </div>
    <div class="col-span-1 h-full bg-white dark:bg-slate-800 rounded-md shadow-md p-4">
      <h1 class="text-center text-lg tracking-wide font-semibold">With greate power comes greate responsibility</h1>
    </div>
  </div>

@endsection