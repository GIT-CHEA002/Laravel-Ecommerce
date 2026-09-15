@extends('layout.client-layout')

@section('title', 'Categories')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
  <div class=" default-padding">
    <ul class="flex items-center flex-wrap gap-1">
      <li class="flex items-center">
        <a href="/" class=" hover:text-indigo-600 transition-colors font-medium">
          Home
        </a>
      </li>
      <li class="flex items-center">
        <x-heroicon-o-chevron-right class="w-3 h-3" />
        <span class="font-semibold">
          Category
        </span>
      </li>
    </ul>
    <div>
      <div class="flex justify-between items-end py-4 border-b-2 mb-4">
        <div class="flex-1">
          <x-shared.section-header>Shop by Category</x-shared.section-header>
          <x-shared.intro-text>
            Explore our catalog of premium enterprise hardware, workspace tools, precision optics, and
            everyday accessories.
          </x-shared.intro-text>
        </div>
        <div class="flex-1 grid place-items-end">
          <x-shared.featured-icon-text icon="check" iconColor="text-indigo-700">
            Guaranteed In-Stock & Direct-Shipped
          </x-shared.featured-icon-text>
        </div>
      </div>

      {{-- categories tag --}}
      @include('client.category.category-tag', ['categories' => $categories])
      {{-- featured categories --}}
      @include('client.category.featured-product', ['products' => $products])

    </div>
  </div>
@endsection