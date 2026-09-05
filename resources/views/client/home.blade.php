@extends('layout.client-layout')
@section('title', 'Home')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
    <div class="max-w-7xl px-4 sm:px-8 md:px-12 py-4 md:py-6">
        @foreach ($featuredProduct as $product)
            {{ $product }}
        @endforeach
    </div>
@endsection