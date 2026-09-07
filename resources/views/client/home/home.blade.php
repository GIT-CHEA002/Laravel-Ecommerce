@extends('layout.client-layout')

@section('title', 'Home')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
    <div class="h-auto max-w-7xl mx-auto">
        @include('client.home.home-hero-section')
        @include('client.home.featured-catgories')
        @include('client.home.featured-product')
        @include('client.home.featured-sectiton')
    </div>
@endsection