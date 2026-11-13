@php
  $breadcrumpLink = [
    ['label' => 'Category', 'url' => route('admin.category.index')],
    ['label' => $category->name . ' (' . $category->categories_id . ')', 'url' => route('admin.category.show', $category)],
  ];
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - Category Detail Information')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  <div class="flex justify-between items-center">
    <div class="flex-1">
      <x-shared.breadcrumb :items="$breadcrumpLink" />
      <x-shared.section-header>Category Detail Information</x-shared.section-header>
      <x-shared.intro-text>
        Manage category attributes then attach your products
      </x-shared.intro-text>
    </div>
    <div class="flex justify-end items-center tracking-wide text-sm">
      <x-heroicon-o-clock class="w-4 h-4 text-indigo-700 dark:text-indigo-500" />
      <h1 class="ps-1">
        <span>Last Modified</span>
        {{-- now(), ['parts' => 2, 'join' => true, 'short' => false] : use this for more time format --}}
        <span class="text-indigo-700 dark:text-indigo-500 font-medium">
          {{ $category->updated_at->diffForHumans() }}
        </span>
        <span>by</span>
        <span class="font-bold">Admin User</span>
      </h1>
    </div>
  </div>
  <div class="grid grid-cols-3 gap-6 py-4 mt-3 border-t auto-rows-auto">
    <div class="col-span-2 space-y-4">
      {{-- general information --}}
      <div class="bg-white dark:bg-slate-800 rounded-md shadow-md p-4 h-fit">
        <div class="py-3 border-b flex justify-between items-center">
          <x-shared.section-header class="flex items-center">
            <x-heroicon-s-pencil-square class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
            <span>General Information</span>
          </x-shared.section-header>
          <span class="text-xs tracking-wide">*Required Fields</span>
        </div>
        <div class="py-2 space-y-4">
          <div class="flex justify-between gap-6">
            <x-shared.display-text label="Category Id">{{ $category->categories_id }}</x-shared.display-text>
            <x-shared.display-text label="Category Name">{{ $category->name }}</x-shared.display-text>
          </div>
          <x-shared.display-text label="Slug">{{ $category->slug }}</x-shared.display-text>
        </div>
      </div>

      {{-- attach product --}}
      <div
        class="flex items-center justify-between gap-4 p-4 tracking-wide bg-white rounded-md shadow-md dark:bg-slate-800">
        {{-- left: total count --}}
        <div class="flex items-center gap-3">
          <div class="flex items-center justify-center w-10 h-10 bg-indigo-100 rounded-md dark:bg-slate-700">
            <x-heroicon-o-cube class="w-5 h-5 text-indigo-700 dark:text-indigo-500" />
          </div>
          <div>
            <h1 class="text-sm font-semibold dark:text-white">
              <span class="text-indigo-700 dark:text-indigo-500">{{  $category->products->count() }}
                {{ Str::plural('product', $category->products()->count()) }}</span>
            </h1>
            <p class="text-xs text-gray-500 dark:text-gray-400">in this category</p>
          </div>
        </div>
        {{-- right: current range --}}
        <h2 class="px-3 py-1 text-xs text-indigo-700 bg-indigo-100 rounded-full dark:bg-slate-700 dark:text-indigo-400">
          @if ($products->isNotEmpty())
            Showing
            <span class="font-semibold">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
            of
            <span class="font-semibold">{{ $category->products->count() }}</span>
          @else
            No products found
          @endif
        </h2>
      </div>
      @if ($products->isNotEmpty())
        <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit my-3 overflow-hidden">
          <table class="w-full text-sm text-left dark:text-white">
            <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
              <tr class="font-light">
                @foreach (['Image', 'Product Name', 'Price', 'Stock', 'Status', 'Action'] as $heading)
                  <th class="px-3 py-3">{{ $heading }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody class="divide-y">
              @forelse ($products as $product)
                <tr>
                  <td class="px-3 py-2">
                    <div class="w-10 h-10 rounded-md overflow-hidden">
                      <img
                        src="{{ $product->productImages->first()?->image_url ?? 'https://placehold.co/200x300?text=No+Image' }}"
                        alt="{{ $product->name }}" class="object-cover w-full h-full">
                    </div>
                  <td class="px-3 py-2">{{ $product->name }} </td>
                  <td class="px-3 py-2">${{ number_format($product->price, 2) }}</td>
                  <td class="px-3 py-2">{{ $product->stock_quantity }}</td>
                  <td class="px-3 py-2">
                    @if ($product->is_on_market)
                      @if ($product->stock_quantity == 0)
                        <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">
                          Out of Stock
                        </x-shared.badge-tag>
                      @elseif ($product->stock_quantity <= 10)
                        <x-shared.badge-tag bgColor="bg-amber-100" textColor="text-amber-600">
                          Low Stock
                        </x-shared.badge-tag>
                      @else
                        <x-shared.badge-tag>In Stock</x-shared.badge-tag>
                      @endif
                    @else
                      <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">
                        Not Available
                      </x-shared.badge-tag>
                    @endif
                  </td>
                  <td class="px-3 py-2">
                    <div class="flex justify-start items-center gap-3">
                      <a href="{{ route('admin.products.show', $product) }}" title="View">
                        <x-heroicon-o-eye class="w-4 h-4 text-indigo-700 dark:text-indigo-500" />
                      </a>
                      <a href="{{ route('admin.products.edit', $product) }}" title="Edit">
                        <x-heroicon-o-pencil class="w-4 h-4 text-yellow-700 dark:text-yellow-500" />
                      </a>
                      @if ($product->is_on_market)
                        @can('update', $product)
                          <div x-data="{ isDeleteOpen: false }">
                            <button type="button" @click="isDeleteOpen = true" class="cursor-pointer" title="Detach">
                              <x-heroicon-o-trash class="w-4 h-4 text-red-700 dark:text-red-500" />
                            </button>
                            <x-shared.confirm-dialog show="isDeleteOpen" title="Deactivate Product"
                              message="Are you sure you want to deactivate this product?" method="PATCH"
                              action="{{ route('admin.category.products.detach', [$category, $product]) }}"
                              confirmText="Detach" />
                          </div>
                        @endcan
                      @else
                        @can('restore', $product)
                          <div x-data="{ isRestoreOpen: false }">
                            <button type="button" @click="isRestoreOpen = true" class="cursor-pointer" title="Restore">
                              <x-heroicon-s-arrow-uturn-left class="w-4 h-4 text-green-700 dark:text-green-500" />
                            </button>
                            <x-shared.confirm-dialog show="isRestoreOpen" title="Restore Product"
                              confirmStyle="bg-green-700 dark:bg-green-500"
                              message="Are you sure you want to restore this product?" method="PATCH"
                              action="{{ route('admin.products.restore', $product) }}" confirmText="Restore" />
                          </div>
                        @endcan
                      @endif
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-3 py-6 text-center text-gray-500">
                    No products in this category yet.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="py-3">
          {{ $products->links() }}
        </div>
      @endif
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
          <img src="{{ $category->image_url ?: 'https://placehold.co/200x300?text=No+Image' }}"
            alt="{{ $category->name }}" class="object-cover w-full h-[200px] rounded">
        </div>
        <h1 class="text-sm tracking-wide font-semibold pt-1 text-center">This image describes the category</h1>
      </div>
      <div class="flex justify-between items-center gap-4">
        <x-button.primary-button href="{{ route('admin.category.index') }}" class="w-full bg-green-700 dark:bg-green-500">
          Back
        </x-button.primary-button>
        <x-button.primary-button href="{{ route('admin.category.product.attach.index', $category)  }}"
          class="w-full bg-green-700 dark:bg-green-500">
          Attch Product
        </x-button.primary-button>
      </div>

      <x-button.primary-button href="{{ route('admin.category.edit', $category) }}" class="w-full">
        Edit Category
      </x-button.primary-button>
    </div>
  </div>
@endsection