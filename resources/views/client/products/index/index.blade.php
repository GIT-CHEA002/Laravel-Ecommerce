@extends('layout.client-layout')

@section('title', 'Shopping')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 py-4 md:py-6">
        {{-- intro sections --}}
        <div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 auto-rows-auto">
            {{-- Sidebar filters --}}
            @include('client.products.index.sidebar', ['categories' => $categories])

            {{-- Product listing --}}
            @include('client.products.index.product-listing', ['products' => $products])
        </div>
    </div>
@endsection