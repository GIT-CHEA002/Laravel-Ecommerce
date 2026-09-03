@extends('layout.auth-layout')
@section('title', 'Login')
@section('favicon', asset('images/favicons/login.png'))
@section('content')
    <div class="py-12">
        <x-shared.toggle-theme />
        <x-form.form-wrapper>
            <x-form.form>
                <h1 class="text-center text-2xl font-medium tracking-wide">Register </h1>
                <x-form.field name="email" label="Email Address" type="email" placeholder="johndoe@gmail.com" />
                <x-form.field name="password" label="Password" type="password" placeholder="Your password" />
                <x-form.button>Register</x-form.button>
            </x-form.form>
            <div class="flex justify-between items-center text-sm tracking-wide">
                <a href="/forgotpassword"
                    class="  capitalize text-indigo-700 font-medium cursor-pointer hover:underline underline-offset-2">
                    Forgot password ?
                </a>
                <div class="flex-1 text-end">
                    <span>Don't Have an Account? </span>
                    <a href="/register"
                        class=" capitalize text-indigo-700 font-medium cursor-pointer hover:underline underline-offset-2">
                        Register First
                    </a>
                </div>
            </div>
        </x-form.form-wrapper>
    </div>
@endsection