@extends('layout.client-layout')

@section('title', 'Show')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 py-4 md:py-6">
        <ul class="flex items-center flex-wrap gap-1">
            <li class="flex items-center">
                <a href="/" class=" hover:text-indigo-600 transition-colors font-medium">
                    Home
                </a>
            </li>
            <li class="flex items-center">
                <x-heroicon-o-chevron-right class="w-3 h-3" />
                <a href="/client/product" class=" hover:text-indigo-600 transition-colors font-medium">
                    Product
                </a>
            </li>
            <li class="flex items-center">
                <x-heroicon-o-chevron-right class="w-3 h-3" />
                <span class=" font-semibold">
                    {{ $product->name }}
                </span>
            </li>
        </ul>
        @include('client.products.show.detail', ['product' => $product])
    </div>
@endsection