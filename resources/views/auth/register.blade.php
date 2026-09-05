@extends('layout.auth-layout')
@section('title', 'Register')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
   <div class="py-12">
      <x-form.form-wrapper>
         <x-form.form action="{{ route('register-user') }}" method="POST">
            <h1 class="text-center text-2xl font-medium tracking-wide">Register </h1>
            <x-form.field name="firstname" label="First Name" placeholder="Jonh" />
            <x-form.field name="lastname" label="Last Name" placeholder="Doe" />
            <x-form.field name="email" label="Email Address" type="email" placeholder="johndoe@gmail.com" />
            <x-form.field name="password" label="Password" type="password" placeholder="Your password" />
            <x-form.field name="password_confirmation" label="Confirm Password" type="password"
               placeholder="Retype your password " />
            <x-form.button>Register</x-form.button>
         </x-form.form>
         <div class="text-center text-sm tracking-wide">
            <span>Have an Account? </span>
            <a href="{{ route('login-user') }}"
               class=" capitalize text-indigo-700 font-medium cursor-pointer hover:underline underline-offset-2">back to
               login</a>
         </div>
      </x-form.form-wrapper>


   </div>
@endsection