@php
  $departments = [
    ['label' => 'All Departments', 'count' => 0, 'value' => null, 'active' => true],
    ['label' => 'Audio & Studio Sound', 'value' => 'audio-studio-sound', 'active' => false],
    ['label' => 'Peripherals & Keyboards', 'value' => 'peripherals-keyboards', 'active' => false],
    ['label' => 'Cameras & Optics', 'value' => 'cameras-optics', 'active' => false],
    ['label' => 'Desk & Office', 'value' => 'desk-office', 'active' => false],
    ['label' => 'Leather & Travel Goods', 'value' => 'leather-travel-goods', 'active' => false],
  ];
@endphp

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
      <div class="">
        {{-- categories tag --}}
        <div class="flex items-center justify-start gap-3 pb-8">
          <x-shared.pilltab href="{{ route('category.index') }}" :active="is_null($categoryId)">
            All Departments
          </x-shared.pilltab>
          @foreach ($categories as $category)
            <x-shared.pilltab href="{{ route('category.index', ['category' => $category->categories_id]) }}"
              :active="(string) $categoryId === (string) $category->categories_id">{{$category->name}}</x-shared.pilltab>
          @endforeach
        </div>
        {{-- featured categories --}}
        <div class="">
          <x-shared.section-header>Primary Departments</x-shared.section-header>
          <x-shared.intro-text class="text-sm">Direct navigation through structured parent
            collections</x-shared.intro-text>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 py-3">
            @foreach ($products as $product)
              <x-card.quaternary-card-style :product="$product" />
            @endforeach

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection