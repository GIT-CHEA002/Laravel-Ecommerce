@extends('layout.client-layout')

@section('title', 'Trending products')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
  <div class=" default-padding">
    @include('client.product.trending.trending-page-header')
    @include('client.product.trending.pill-tag')
    {{-- trending today --}}
    @include('client.product.trending.trending-today', ['product' => $products->first()])
    @include('client.product.trending.trending-product', ['products' => $products])
  </div>
@endsection
@stack('scripts')