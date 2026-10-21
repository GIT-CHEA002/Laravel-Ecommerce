@php
  $breadcrumpLink = [
    ['label' => 'Category', 'url' => route('admin.category.index')],
    ['label' => 'Create', 'url' => route('admin.category.create')],
  ];
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - category Management')
@section('page-heading', 'Product Create Form')
@section('content')
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.breadcrumb :items="$breadcrumpLink" />
      <x-shared.section-header>Category - Create Form</x-shared.section-header>
    </div>
  </div>
  {{-- create form --}}
  <x-form.form class="py-3 space-y-4" action="{{ route('admin.category.store') }}" method="POST">
    <div class="flex justify-between items-center  gap-6">
      <x-form.field name="name" label="Name" placeholder="Fragrance..." class="flex-1 py-2" />
      <x-form.field name="slug" label="Slug" placeholder="EDT/EDP..." class="flex-1 py-2" />
    </div>
    <div class="flex justify-between items-center  gap-6">
      <x-form.field name="image" label="Image Url" placeholder="https://placeholder/200/300" class="flex-1 py-2" />
      <div class="">
        <label for="" class="opacity-0">Category</label>
        <x-form.checkbox name="is_listing" label="Avaible(On Market ?)" />
      </div>
    </div>
    <div class="flex justify-end  items-center gap-3 mt-2">
      <div class="w-1/4  flex justify-end items-center">
        <x-button.primary-button href="{{ url()->previous()}}"
          class="bg-red-700 dark:bg-red-500">Cancel</x-button.primary-button>
      </div>
      <div class="w-1/4 ">
        <x-form.button class="rounded-md capitalize">Add New Product</x-form.button>
      </div>
    </div>
  </x-form.form>
@endsection