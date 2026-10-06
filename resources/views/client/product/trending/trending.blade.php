@extends('layout.client-layout')

@section('title', 'Trending products')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
  <div class=" default-padding">
    @include('client.product.trending.trending-page-header')
    {{-- pills --}}
    @include('client.product.trending.pill-tag')
    {{-- trending today --}}
    @include('client.product.trending.trending-today')
    @include('client.product.trending.trending-product', ['trendingProduct' => $trendingProduct])
  </div>
@endsection
@stack('scripts')