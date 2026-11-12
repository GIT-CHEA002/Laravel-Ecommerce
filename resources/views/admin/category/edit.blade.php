@extends('layout.admin-layout')
@section('title', 'Admin - category Management')
@section('page-heading', 'Product Management')
@section('content')
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.section-header>Category - Edit form</x-shared.section-header>
      <x-shared.intro-text>Manage your store inventory and listings</x-shared.intro-text>
    </div>
  </div>
  <x-form.form id="update-category" class="py-3 space-y-4" action="{{ route('admin.category.update', $category) }}"
    method="POST">
    @csrf
    @method('PATCH')
    <div class="flex justify-between items-center  gap-6">
      <x-form.field name="name" label="Name" placeholder="Fragrance..." value="{{ old('name', $category->name) }}"
        class="flex-1 py-2" />
      <x-form.field name="slug" label="Slug" placeholder="EDT/EDP..." value="{{ old('slug', $category->slug) }}"
        class="flex-1 py-2" />
    </div>
    <div class="flex justify-between items-center  gap-6">
      <x-form.field name="image" label="Image Url" placeholder="https://placeholder/200/300"
        value="{{ old('image', $category->image_url) }}" class="flex-1 py-2" />
    </div>
  </x-form.form>
  <div class="flex justify-end  items-center gap-3 mt-2">
    <div class="w-1/4  flex justify-end items-center gap-4">
      <x-button.primary-button href="{{ url()->previous() }}">Back</x-button.primary-button>
      @if ($category->is_listing == false)
        @can('restore', $category)
          <div x-data="{isRestoreOpen : false}">
            <x-form.button type="button" @click="isRestoreOpen = true" class="rounded-md capitalize "
              defaultColor="bg-green-600 hover:bg-green-700">
              Restore
            </x-form.button>
            <x-shared.confirm-dialog show="isRestoreOpen" title="Restore category"
              message="Are you sure want to restore this category" method="PATCH" confirmText="Restore"
              confirmStyle="bg-green-700 dark:bg-green-500" action="{{ route('admin.category.restore', $category) }}" />
          </div>
        @endcan
      @endif
      @if ($category->is_listing == true)
        @can('delete', $category)
          <div x-data="{isDeleteOpen : false}">
            <x-form.button type="button" @click="isDeleteOpen = true" class="rounded-md capitalize "
              defaultColor="bg-red-600 hover:bg-red-700">
              Deactivate
            </x-form.button>
            <x-shared.confirm-dialog show="isDeleteOpen" title="Deactivate category"
              message="Are you sure want to deactivate this category" method="DELETE" confirmText="Deactivate"
              confirmStyle="bg-red-700 dark:bg-red-500" action="{{ route('admin.category.destroy', $category) }}" />
          </div>
        @endcan
      @endif
    </div>
    <div class=" flex justify-between items-center gap-4">
      @can('forceDelete', $category)
        <div x-data="{isForceDeleteOpen : false}">
          <x-form.button type="button" @click="isForceDeleteOpen = true" class="rounded-md capitalize "
            defaultColor="bg-red-600 hover:bg-red-700">
            Delete
          </x-form.button>
          <x-shared.confirm-dialog show="isForceDeleteOpen" title="Deactivate category"
            message="Are you sure want to permanantly delete this category. This Action can not be undo!" method="DELETE"
            confirmText="Delete" confirmStyle="bg-red-700 dark:bg-red-500"
            action="{{ route('admin.category.forceDelete', $category) }}" />
        </div>
      @endcan
      <x-form.button form="update-category" class="rounded-md capitalize">Update category</x-form.button>
    </div>
  </div>
@endsection