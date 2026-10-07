@php
  $summaryInfo = [
    [
      'title' => 'Total Revenue',
      'value' => '$124,563.00',
      'icon' => 'banknotes',
      'change' => '+12.5% from last month',
      'trend' => 'up',
    ],
    [
      'title' => 'Orders',
      'value' => '1,245',
      'icon' => 'shopping-cart',
      'change' => '+5.2% from last month',
      'trend' => 'up',
    ],
    [
      'title' => 'Customers',
      'value' => '8,932',
      'icon' => 'users',
      'change' => '+18.1% from last month',
      'trend' => 'up',
    ],
    [
      'title' => 'Products',
      'value' => '456',
      'icon' => 'archive-box',
      'change' => 'Steady inventory',
      'trend' => 'neutral',
    ],
    [
      'title' => 'Categories',
      'value' => '24',
      'icon' => 'rectangle-group',
      'change' => '2 new added',
      'trend' => 'neutral',
    ],
  ];
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - Over view (Dashboard)')
@section('page-heading', 'Product Management')
@section('content')
  <div class="">
    <h1 class="text-3xl tracking-wide capitalize font-bold">DashBoard overview</h1>
    <x-shared.intro-text>Welcome back. Here's what's happening with your store today.</x-shared.intro-text>
    {{-- overview section --}}
    @include('admin.dashboard.summary', ['summaryInfo' => $summaryInfo])
  </div>
@endsection