@extends('layout.client-layout')
@section('title', 'Shopping Cart')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 py-4 md:py-6">
    <x-shared.section-header>Your shopping cart</x-shared.section-header>
    <x-shared.intro-text>You have 2 items in your cart</x-shared.intro-text>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-4">
      {{-- display product cart --}}
      <div class="md:col-span-2 rounded-md p-3 border bg-white dark:bg-slate-800">
        @foreach ($carts as $item)
          @include('client.cart.product-cart-card', ['item' => $item])
        @endforeach
      </div>
      {{-- summary sections --}}
      @include('client.cart.summary')
    </div>
  </div>
@endsection
@stack('scripts')