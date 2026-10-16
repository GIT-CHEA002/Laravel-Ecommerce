@extends('layout.admin-layout')
@section('title', 'Admin - category Management')
@section('page-heading', 'Product Management')
@section('content')
  <div class="">
    <x-shared.section-header>category Tab</x-shared.section-header>
    <h1>{{ $categories }}</h1>
  </div>
@endsection