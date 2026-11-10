@extends('layout.admin-layout')
@section('title', 'Admin - User')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
  <div class="">
    <h1>Customer Tab : Showing </h1>
  </div>
  @if ($user->isAdmin())
    {{-- show for admin user --}}
    Admin: {{ $user->first_name }} - {{ $user->last_name }}
  @else
    {{-- for client user --}}
    User: {{ $user->first_name }}
  @endif
@endsection