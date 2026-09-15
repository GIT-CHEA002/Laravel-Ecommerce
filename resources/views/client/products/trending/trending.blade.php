@extends('layout.client-layout')

@section('title', 'Trending products')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
  <div class=" default-padding">
    <div class="">
      <ul class="flex items-center flex-wrap gap-1">
        <li class="flex items-center">
          <a href="/" class=" opacity-50 hover:opacity-100 hover:text-indigo-600 transition-colors font-medium">
            Home
          </a>
        </li>
        <li class="flex items-center">
          <x-heroicon-o-chevron-right class="w-3 h-3" />
          <span class=" font-semibold">
            Trending
          </span>
        </li>
      </ul>
      <div class=" block md:flex justify-between  items-center border-b-2 border-indigo-700 dark:border-indigo-500 ">
        <div class="flex-1 py-6">
          <x-shared.section-header class="my-2">Trending Now & Hot Releases</x-shared.section-header>
          <x-shared.intro-text>
            Explore the most coveted workspace gear, audio engineering essentials, and viral tech accessories moving fast
            today.
          </x-shared.intro-text>
        </div>
      </div>
      <div class=" py-2 flex items-center gap-4 justify-start overflow-x-auto flex-nowrap">
        @foreach ($categories as $category)
          <x-shared.pilltab :active="true">{{ $category->name }}</x-shared.pilltab>
        @endforeach
      </div>
      {{-- trending today --}}
      <div
        class="my-4 block h-fit items-start justify-between gap-6 rounded-md border bg-white p-4 dark:border-slate-600 dark:bg-slate-800 md:flex">
        {{-- Product image --}}
        <div class="h-full rounded-md py-4 md:w-1/3">
          <img src="https://picsum.photos/600/600" alt="Aura Pro Wireless Headphones"
            class="h-full w-full rounded-md object-cover">
        </div>

        {{-- Product information --}}
        <div class="h-fit flex-1">
          {{-- Product badges --}}
          <div class="flex items-center justify-between pb-2">
            <span class="text-sm font-medium uppercase tracking-wide text-indigo-700 dark:text-indigo-500">
              Special Edition Release
            </span>

            <span class="rounded-sm bg-red-100 px-2 text-xs font-medium tracking-wide text-red-700 dark:text-red-500">
              Only 14 units remaining in stock
            </span>
          </div>

          {{-- Product name --}}
          <x-shared.section-header>
            Aura Pro Wireless Headphones — Indigo Edition
          </x-shared.section-header>

          {{-- Rating --}}
          <div class="items-center justify-start gap-2 md:flex">
            <x-shared.rating-star count="1,420 verified buyer ratings" color="text-amber-500" />

            <span class="hidden md:block">|</span>

            <x-shared.featured-icon-text class="text-green-600" icon="arrow-trending-up">
              99% Satisfaction
            </x-shared.featured-icon-text>
          </div>

          {{-- Description --}}
          <x-shared.intro-text class="border-b pb-4">
            Custom-tuned 45mm neodymium drivers, active planar acoustic chamber,
            and 60-hour hyper-charge battery. Crafted specifically for master
            engineers, creators, and discerning audiophiles.
          </x-shared.intro-text>

          {{-- Price and actions --}}
          <div class="block items-center justify-between gap-2 py-2 md:flex">
            <div>
              <div class="w-fit space-x-2">
                <span class="text-3xl font-bold tracking-wide">
                  ${{ number_format(299, 2) }}
                </span>

                <span class="intro-text-color line-through">
                  ${{ number_format(349, 2) }}
                </span>

                <span class="rounded bg-green-100 px-2 text-xs font-bold text-green-700">
                  Save $50
                </span>
              </div>

              <x-shared.intro-text>
                Includes complimentary magnetic charging stand ($49 value)
              </x-shared.intro-text>
            </div>

            <div class="block items-center justify-between gap-4 space-y-4 md:flex md:space-y-0">
              <x-button.quantity-selector class="h-fit" />

              <x-button.primary-button href="#" class="w-full justify-center text-nowrap text-xs md:w-fit">
                <span class="text-sm">
                  Claim Yours / Add to Cart
                </span>
              </x-button.primary-button>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
@endsection
@stack('scripts')