@extends('layout.client-layout')

@section('title', 'Shopping')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 py-4 md:py-6">
        {{-- intro sections --}}
        <ul class="flex items-center flex-wrap gap-1">
            <li class="flex items-center">
                <a href="/" class="text-gray-500 hover:text-indigo-600 transition-colors font-medium">
                    Home
                </a>
            </li>
            <li class="flex items-center">
                <x-heroicon-o-chevron-right class="w-3 h-3" />
                <span class="text-gray-900 font-semibold">
                    Shop
                </span>
            </li>
        </ul>
        <div class=" block md:flex justify-between  items-center">
            <div class="flex-1 py-6">
                <x-shared.section-header class="my-2">Collections</x-shared.section-header>
                <x-shared.intro-text>
                    The entire application is structured to be compatible with Vue.js and the DummyJSON
                    API,
                    featuring responsive layouts and a consistent component library. Every screen is now live on your canvas
                    for review.
                </x-shared.intro-text>
            </div>
            <div class="flex-1 text-end">
                <span class="text-indigo-700 dark:text-indigo-500 cursor-pointer  font-bold tracking-wide">Sort By : </span>
                <select name="sort_option" id="sort_option"
                    class=" capitalize px-2 bg-indigo-700 rounded-md text-white border-none focus:ring-0 outline-none">
                    <option value="category" default>
                        categories
                    </option>
                    <option value="price">
                        price
                    </option>
                    <option value="trending">
                        trending
                    </option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 auto-rows-auto">
            {{-- Sidebar filters --}}
            @include('client.products.index.sidebar', ['categories' => $categories])
            {{-- Product listing --}}
            @include('client.products.index.product-listing', ['products' => $products])
        </div>
    </div>
@endsection