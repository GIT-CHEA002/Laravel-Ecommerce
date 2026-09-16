@extends('layout.client-layout')

@section('title', 'Trending products')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
  <div class=" default-padding">
    @include('client.products.trending.trending-page-header')
    {{-- pills --}}
    @include('client.products.trending.pill-tag')
    {{-- trending today --}}
    @include('client.products.trending.trending-today')

    <div class="py-5">
      <x-shared.section-header>Fast-Moving Inventory</x-shared.section-header>
      <x-shared.intro-text>
        Real-time demand tracking calculated by sales volume, views, and live cart
        events.
      </x-shared.intro-text>
      <div class="py-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 items-stretch ">
        @foreach ($trendingProduct as $product)
          @include('client.products.trending.trending-product-card', [
            'product' => $product,
            'target' => route('product.show', $product),
            'badgeTag' => $product->slug,
          ])
        @endforeach
      </div>
      <div class="py-4">
        {{ $trendingProduct->links() }}
      </div>
    </div>
  </div>
@endsection
@stack('scripts')