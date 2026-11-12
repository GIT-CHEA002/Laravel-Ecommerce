@php
  $breadcrumpLink = [
    ['label' => 'Users', 'url' => route('admin.user.index')],
    ['label' => 'Admin', 'url' => route('admin.user.admin')],
    ['label' => 'Show'],
  ];
  // check if the address is exist or not
  $userAddress = $user->defaultAddress;
@endphp

@extends('layout.admin-layout')
@section('title', 'Admin - User')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  @if ($user->isAdmin())
    <x-shared.breadcrumb :items="$breadcrumpLink" />
    <div class="flex justify-between items-center">
      <div class="block">
        <x-shared.section-header>Admin : {{ $user->first_name }}--{{ $user->last_name }} </x-shared.section-header>
        <x-shared.intro-text>Be admin on : {{ $user->created_at->format('l d F Y') }}</x-shared.intro-text>
      </div>
      @can('update', $user)
        <x-button.primary-button href="{{ route('admin.user.edit', $user) }}">Edit</x-button.primary-button>
      @endcan
    </div>
    <div class="grid grid-cols-3 gap-6 py-4 mt-3  border-t auto-rows-auto">
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
            <x-shared.display-text label="First Name">{{ $user->first_name }}</x-shared.display-text>
            <x-shared.display-text label="Last Name">{{ $user->last_name }}</x-shared.display-text>
          </div>

          <div class="py-2 flex items-center justify-between gap-3">
            <x-shared.display-text label="Phone Number" class="flex-1">071 57 63 3996</x-shared.display-text>
            <x-shared.display-text label="Email Address" class="flex-1">{{ $user->email }}</x-shared.display-text>
          </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-md shadow-md p-4 h-fit">
          <div class="py-3 border-b flex justify-between items-center">
            <x-shared.section-header class="flex items-center">
              <x-heroicon-s-map-pin class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
              <span>Address and Location</span>
            </x-shared.section-header>
            <span class="text-xs tracking-wide">*Required Fields</span>
          </div>

          @if ($userAddress)
            <div class="space-y-4">
              <x-shared.display-text label="Address Line">{{ $userAddress?->address_line }}</x-shared.display-text>

              <div class="flex gap-3 justify-between items-center">
                <x-shared.display-text label="City">{{ $userAddress?->city }}</x-shared.display-text>
                <x-shared.display-text label="Postal Code">{{ $userAddress?->postal_code }}</x-shared.display-text>
              </div>
            </div>
          @else
            <div class="pt-3">
              <h1 class="text-lg font-semibold tracking-wide  text-center animate-pulse">User haven't attached address yet
              </h1>
            </div>
          @endif

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
            <img src="{{ $user->avatar ?: 'https://placehold.co/200x300?text=No+Image' }}" alt="{{ $user->first_name }}"
              class="object-cover w-full h-[200px] rounded">
          </div>
          <h1 class="text-sm tracking-wide capitalize pt-1 text-start">
            update on :
            {{ $user->updated_at->format('l d F Y') }}
          </h1>
        </div>
        <div class="py-4">
          <x-button.primary-button href="{{ route('admin.user.admin') }}" class="w-full">Back</x-button.primary-button>
        </div>
      </div>
    </div>
  @else
    User : {{ $user->first_name }} - {{ $user->last_name }}
  @endif
@endsection