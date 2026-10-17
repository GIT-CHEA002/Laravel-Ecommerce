@extends('layout.admin-layout')
@section('title', 'Admin - category Management')
@section('page-heading', 'Product Management')
@section('content')
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.section-header>Category - Overview</x-shared.section-header>
      <x-shared.intro-text>Manage your store inventory and listings</x-shared.intro-text>
    </div>
    <x-button.primary-button href="{{ route('admin.products.create') }}">
      <x-heroicon-o-plus class="w-5 h-5" />
      <span class="capitalize text-sm tracking-wide">Add Category</span>
    </x-button.primary-button>
  </div>
@endsection