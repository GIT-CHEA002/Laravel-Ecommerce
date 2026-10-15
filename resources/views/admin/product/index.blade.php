@extends('layout.admin-layout')

@section('title', 'Admin - Product Management')
@section('page-heading', 'Product Management')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
    <div>
        {{-- header section --}}
        <div class="flex justify-between items-center">
            <div class="block">
                <x-shared.section-header>Products</x-shared.section-header>
                <x-shared.intro-text>Manage your store inventory and listings</x-shared.intro-text>
            </div>
            <x-button.primary-button href="{{ route('admin.products.create') }}">
                <x-heroicon-o-plus class="w-5 h-5" />
                <span class="capitalize text-sm tracking-wide">Add product</span>
            </x-button.primary-button>
        </div>
        {{-- search and filter section --}}
        <div class="flex justify-between items-center bg-white dark:bg-slate-800 p-3 rounded-md shadow-md mt-3">
            {{-- form to search --}}
            <x-form.form class="w-1/4">
                <x-form.field name="product" placeholder="search product..."
                    class="py-1 tracking-wide space-y-0 placeholder:capitalize" icon="magnifying-glass" />
            </x-form.form>
            {{-- filter section --}}
            <div class="flex justify-end items-center gap-4">
                <x-form.select name="category" placeholder="All Category" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" onchange="this.form.submit()" />
                <x-form.select name="status" placeholder="All Statuses" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" onchange="this.form.submit()" />
            </div>
        </div>

        {{-- Display table --}}
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
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-3 py-2">
                                <div class="w-10 h-10 rounded-md overflow-hidden">
                                    <img src="{{ $product->productImages->first()?->image_url ?? 'https://picsum.photos/200/300' }}"
                                        alt="{{ $product->name }}" class="object-cover w-full h-full">
                                </div>
                            </td>
                            <td class="px-3 py-2">{{ $product->name }}</td>
                            <td class="px-3 py-2">${{ number_format($product->price, 2) }}</td>
                            <td class="px-3 py-2">{{ $product->stock_quantity }}</td>
                            <td class="px-3 py-2">
                                @if ($product->is_on_market)
                                    @if ($product->stock_quantity == 0)
                                        <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">
                                            Out Stock
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
                                    <a href="{{ route('admin.products.show', $product) }}">
                                        <x-heroicon-o-eye class="w-4 h-5 text-indigo-700 dark:text-indigo-500" />
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}">
                                        <x-heroicon-o-pencil class="w-4 h-5 text-yellow-700 dark:text-yellow-500" />
                                    </a>
                                    @can('delete', $product)
                                        <div x-data="{openDelete: false}">
                                            <button type="button" @click="openDelete = true" class="cursor-pointer">
                                                <x-heroicon-o-trash class="w-4 h-5 text-red-700 dark:text-red-500" />
                                            </button>
                                            <x-shared.confirm-dialog show="openDelete" title="Delete Product"
                                                message="Are you sure want to soft delete this product"
                                                action="{{ route('admin.products.destroy', $product) }}" confirmText="Delete" />
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
            {{ $products->links() }}
        </div>
    </div>
@endsection