@extends('layout.auth-layout')
@section('title', 'Reset Password')
@section('favicon', asset('images/favicons/register.png'))
@section('content')

    <x-form.form-wrapper class="mt-6">
        <h1 class="text-lg font-semibold tracking-wide text-center">Forgot Password</h1>

        @if (session('status'))
            <div class="my-4 rounded bg-green-100 text-green-800 p-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <x-form.form method="POST" action="{{ route('auth.password.email') }}" class="space-y-3">
            <x-form.field name="email" type="email" placeholder="johndoe@gmail.com" label="Enter your email" />

            <x-links.secondary-link href="{{ route('auth.login') }}"
                class=" justify-end text-xs tracking-wide text-indigo-700 dark:text-indigo-500 hover:underline underline-offset-2">
                Back to Login
            </x-links.secondary-link>
            <x-form.button type="submit" class="rounded-md">Send Reset Link</x-form.button>

        </x-form.form>
    </x-form.form-wrapper>
@endsection