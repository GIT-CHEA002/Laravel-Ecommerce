@extends('layout.admin-layout')
@section('title', 'Admin - Product Information')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
    <div class="flex justify-between items-center">
        <div class="flex-1">
            <x-shared.section-header>Product Detail view</x-shared.section-header>
            <x-shared.intro-text>
                Manage products attributes, catalog taxonomy, inventory, and media assets.
            </x-shared.intro-text>
        </div>
        <div class="flex justify-end items-center tracking-wide text-sm">
            <x-heroicon-o-clock class="w-4 h-4 text-indigo-700 dark:text-indigo-500" />
            <h1 class="ps-1">
                <span>Last Modified</span>
                {{-- now(), ['parts' => 2, 'join' => true, 'short' => false] : use this for more time format --}}
                <span class="text-indigo-700 dark:text-indigo-500 font-medium">
                    {{ $product->updated_at->diffForHumans() }}
                </span>
                <span>by</span>
                <span class="font-bold">Admin User</span>
            </h1>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-6 py-4 mt-3  border-t auto-rows-auto">
        <div class="col-span-2 space-y-4">
            <div class="bg-white dark:bg-slate-800 rounded-md shadow-md p-4 h-fit">
                <div class="py-3 border-b flex justify-between items-center">
                    <x-shared.section-header class="flex items-center">
                        <x-heroicon-s-pencil-square class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
                        <span>General Information</span>
                    </x-shared.section-header>
                    <span class="text-xs tracking-wide">*Required Fields</span>
                </div>
                <div class="py-2 space-y-4">
                    <x-shared.display-text label="Product Name">{{ $product->name }}</x-shared.display-text>
                    <x-shared.display-text
                        label="Short Tagline and Summary">{{ Str::limit($product->description, 150) }}</x-shared.display-text>
                    <x-shared.display-text label="Descritpion">{{ $product->description }}</x-shared.display-text>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-md shadow-md p-4 h-fit">
                <div class="py-3 border-b flex justify-between items-center">
                    <x-shared.section-header class="flex items-center">
                        <x-heroicon-o-adjustments-horizontal class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
                        <span>Technical Specifications</span>
                    </x-shared.section-header>
                    <span class="text-xs tracking-wide">*Required Fields</span>
                </div>
                @php
                    $specs = [
                        'Brand' => 'Samsung',
                        'Model' => 'Galaxy S24',
                        'Screen' => '6.2 inch AMOLED',
                        'RAM' => '8 GB',
                        'Storage' => '256 GB',
                        'Battery' => '4000 mAh',
                        'Color' => 'Phantom Black',
                        'Warranty' => '12 months',
                    ];
                @endphp

                <div class="py-2 grid grid-cols-2 gap-4">
                    @foreach ($specs as $label => $value)
                        <x-shared.display-text :label="$label">{{ $value }}</x-shared.display-text>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-span-1 space-y-4">
            <div class="p-4 shadow-md bg-white dark:bg-slate-800 rounded-md">
                <div class="py-3 border-b">
                    <x-shared.section-header class="flex items-center">
                        <x-heroicon-s-currency-dollar class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
                        <span>Pricing & Margins</span>
                    </x-shared.section-header>
                </div>
                <div class="py-2 space-y-4">
                    <x-shared.display-text label="Retails Price"
                        class="font-bold text-xl">${{ number_format($product->price + 100, 2) }}</x-shared.display-text>
                    <div class="flex justify-between gap-3">
                        <x-shared.display-text
                            label="Regular List">${{ number_format($product->price, 2) }}</x-shared.display-text>
                        <x-shared.display-text
                            label="Cost Per Items">${{ number_format($product->price - 400, 2) }}</x-shared.display-text>
                    </div>
                    <div class="bg-indigo-50 dark:bg-slate-900 py-2 px-3  rounded-md ">
                        <h1 class="flex justify-between items-center text-sm tracking-wide capitalize">
                            <span>Estimated Margin</span>
                            <span>Gross profit</span>
                        </h1>
                        <h1 class="flex justify-between items-center text-sm tracking-wide capitalize">
                            <span class="text-green-600 font-bold">
                                {{ number_format(($product->price + 400 - $product->price) / $product->price * 100, 2) }}%
                                Profit
                            </span>
                            <span class="font-bold tracking-wide">${{ number_format(400, 2) }} / unit</span>
                        </h1>
                    </div>
                    <x-shared.display-text label="Tax Treatment">Standard Goods Tax
                        ({{ number_format(10, 2) }}%)</x-shared.display-text>
                </div>
            </div>
            <div class="p-4 shadow-md bg-white dark:bg-slate-800 rounded-md">
                <div class="py-3 border-b">
                    <x-shared.section-header class="flex items-center">
                        <x-heroicon-s-currency-dollar class="w-6 h-6 text-indigo-700 dark:text-indigo-500" />
                        <span>Inventory & Stock</span>
                    </x-shared.section-header>
                </div>
                <div class="py-2 space-y-4">
                    <div class="flex justify-between items-center gap-3">
                        <x-shared.display-text label="Stock on Hand*">
                            {{ $product->stock_quantity }}
                        </x-shared.display-text>
                        <x-shared.display-text label="Low Stock Alert">
                            15
                        </x-shared.display-text>
                    </div>

                    <x-shared.display-text label="Barcode / EAN-13">
                        0849201948201
                    </x-shared.display-text>
                </div>
            </div>
            <x-button.primary-button href="{{ url()->previous() }}"
                class=" w-full bg-red-700 dark:bg-red-500">Back</x-button.primary-button>
            <x-button.primary-button href="{{ route('admin.products.edit', $product) }}" class="w-full">
                Edit product
            </x-button.primary-button>
        </div>
    </div>
@endsection