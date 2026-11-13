@extends('layout.admin-layout')
@section('title', 'Admin - Over view (Dashboard)')
@section('page-heading', 'Product Management')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  <div>
    <h1 class="text-3xl tracking-wide capitalize font-bold">DashBoard overview</h1>
    <x-shared.intro-text>Welcome back. Here's what's happening with your store today.</x-shared.intro-text>
    {{-- overview section --}}
    @include('admin.dashboard.summary', ['summaryInfo' => $summaryInfo])
    @include('admin.dashboard.recent-order-table', ['recentOrder' => $recentOrder])
    @include('admin.dashboard.stock-and-user-grid', ['lowStockProduct' => $lowStockProduct, 'newRegister' => $newRegister])
  </div>
@endsection