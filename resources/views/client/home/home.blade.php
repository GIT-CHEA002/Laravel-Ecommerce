@extends('layout.client-layout')

@section('title', 'Home')
@section('favicon', asset('images/favicons/register.png'))

@section('content')
    <div class="h-screen max-w-7xl mx-auto px-4 sm:px-8 md:px-12 py-4 md:py-6">
        {{-- hero sections --}}
        @include('client.home.home-hero-section')
    </div>
@endsection