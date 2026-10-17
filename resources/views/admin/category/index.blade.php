@extends('layout.admin-layout')
@section('title', 'Admin - category Management')
@section('page-heading', 'Product Management')
@section('content')
  {{-- header--}}
  <div class="flex justify-between items-center">
    <div class="block">
      <x-shared.section-header>Category - Overview</x-shared.section-header>
      <x-shared.intro-text>Manage your store inventory and listings</x-shared.intro-text>
    </div>
    <x-button.primary-button href="{{ route('admin.categories.create') }}">
      <x-heroicon-o-plus class="w-5 h-5" />
      <span class="capitalize text-sm tracking-wide">Add Category</span>
    </x-button.primary-button>
  </div>
  {{-- some details categories with pagination --}}
  <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit my-3 overflow-hidden">
    <table class="w-full text-sm text-left dark:text-white">
      <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
        <tr class="font-light">
          @foreach (['Image', 'Name', 'Status', 'Action'] as $heading)
            <th class="px-3 py-3">{{ $heading }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody class="divide-y">
        @foreach ($categories as $category)
          <tr>
            <td class="px-3 py-2">
              <div class="w-10 h-10 rounded-md overflow-hidden">
                <img src="{{ $category?->productImages?->first()?->image_url ?? 'https://picsum.photos/200/300' }}"
                  alt="{{ $category->name }}" class="object-cover w-full h-full">
              </div>
            </td>
            <td class="px-3 py-2">{{ $category->name }}</td>
            <td class="px-3 py-2">
              {{-- should be is_listing categories --}}
              @if ($category->is_listing === 1)
                <x-shared.badge-tag bgColor="bg-green-100" textColor="text-green-600">
                  Available/Active
                </x-shared.badge-tag>
              @else
                <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">
                  Not Available/Inactive
                </x-shared.badge-tag>
              @endif
            </td>
            <td class="px-3 py-2">
              <div class="flex justify-start items-center gap-3">
                <a href="{{ route('admin.categories.show', $category) }}">
                  <x-heroicon-o-eye class="w-4 h-5 text-indigo-700 dark:text-indigo-500" />
                </a>
                <a href="{{ route('admin.categories.edit', $category) }}">
                  <x-heroicon-o-pencil class="w-4 h-5 text-yellow-700 dark:text-yellow-500" />
                </a>

                @can('delete', $category)
                  <div x-data="{openDelete: false}">
                    <button type="button" @click="openDelete = true" class="cursor-pointer">
                      <x-heroicon-o-trash class="w-4 h-5 text-red-700 dark:text-red-500" />
                    </button>
                    <x-shared.confirm-dialog show="openDelete" title="Delete Category"
                      message="Are you sure want to soft delete this Category"
                      action="{{ route('admin.categories.destroy', $category) }}" confirmText="Delete" />
                  </div>
                @endcan


              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="py-2">
    {{ $categories->links() }}
  </div>

@endsection