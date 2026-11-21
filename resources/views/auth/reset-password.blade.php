@extends('layout.auth-layout')
@section('title', 'Reset Password')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
    <x-form.form-wrapper class="mt-6">
        <x-form.form action="{{ route('password.reset.store') }}" method="POST" class="space-y-3">
            <h1 class="text-center text-2xl font-medium tracking-wide">Reset Password</h1>
            <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                Choose a new password for your account.
            </p>
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <x-form.field name="email" label="Email Address" type="email" :value="old('email', request('email'))"
                placeholder="name@example.com" autocomplete="email" required />

            <x-form.field name="password" label="New Password" type="password" placeholder="At least 8 characters"
                autocomplete="new-password" required />

            <x-form.field name="password_confirmation" label="Confirm New Password" type="password"
                placeholder="Repeat your new password" autocomplete="new-password" required />

            <x-form.button type="submit" class="mt-3 w-full">Reset Password</x-form.button>
        </x-form.form>
    </x-form.form-wrapper>
@endsection