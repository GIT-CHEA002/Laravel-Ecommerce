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
    @include('client.products.trending.trending-product', ['trendingProduct' => $trendingProduct])
  </div>
@endsection
@stack('scripts')