@extends('layout.client-layout')
@section('title', 'Shopping Cart')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
  @if ($carts->isNotEmpty())
    <div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 py-4 md:py-6">
      <x-shared.section-header>Your shopping cart</x-shared.section-header>
      <x-shared.intro-text>
        You have {{ $carts->count() }} {{ Str::plural('item', $carts->count()) }} in your cart
      </x-shared.intro-text>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-4">
        {{-- cart items --}}
        <div class="md:col-span-2 rounded-md p-3 border bg-white dark:bg-slate-800">
          @foreach ($carts as $item)
            @include('client.cart.product-cart-card', ['item' => $item])
          @endforeach
        </div>

        {{-- summary --}}
        @include('client.cart.summary')
      </div>
    </div>
  @else
    {{-- empty cart --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 py-16 md:py-24">
      <div
        class="mx-auto max-w-md rounded-xl border bg-white dark:bg-slate-800 dark:border-slate-700 px-6 py-12 text-center shadow-sm">
        {{-- cart icon --}}
        <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700">
          <x-heroicon-o-shopping-cart class="w-10 h-10 font-bold" />
        </div>

        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Your cart is empty</h1>
        <p class="mt-2 text-slate-500 dark:text-slate-400">
          Looks like you haven't added anything yet. Browse our products and find something you like.
        </p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
          <x-button.primary-button href="{{ route('product.index')}}">Start Shopping</x-button.primary-button>
          <a href="{{ route('product.trending') }}"
            class="rounded-md border px-6 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">
            See trending
          </a>
        </div>
      </div>
    </div>
  @endif
@endsection