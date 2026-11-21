@extends('layout.auth-layout')
@section('title', 'Register')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
   <x-form.form-wrapper class="mt-5">
      <x-form.form action="{{ route('auth.register') }}" method="POST">
         <h1 class=" my-1 text-center text-xl md:text-3xl font-bold tracking-wide">Create an Account </h1>
         <p class="text-center tracking-wide text-sm font-semibold">
            Join <span class="text-indigo-700 dark:text-indigo-500 font-bold">LaraStore Commerce</span> to start
            shopping
         </p>
         <div class="space-y-3">
            <x-form.field name="firstname" label="First Name" placeholder="Jonh" />
            <x-form.field name="lastname" label="Last Name" placeholder="Doe" />
            <x-form.field name="email" label="Email Address" type="email" placeholder="johndoe@gmail.com" />
            <x-form.field name="password" label="Password" type="password" placeholder="Your password" />
            <x-form.field name="password_confirmation" label="Confirm Password" type="password"
               placeholder="Retype your password " />
            {{-- term and privacy agreement --}}
            <div class="flex justify-start items-center gap-2">
               <x-form.checkbox name="term_and_privacy" :label="false" />
               <h1 class="text-sm tracking-wide">
                  I agree to the
                  <span class="text-indigo-700 dark:text-indigo-500 font-bold">Terms of Service</span>
                  and
                  <span class="text-indigo-700 dark:text-indigo-500 font-bold">Privacy</span>
               </h1>
            </div>
         </div>
         <x-form.button class="mt-3 py-3 rounded-md capitalize font-medium">Create Account</x-form.button>
      </x-form.form>
      <x-form.devider displayText="Or Continue With" />
      {{-- social sign in --}}
      <div class="flex justify-between items-center gap-4">
         <x-links.social-link href="{{ route('auth.google.redirect') }}" class="flex-1">
            <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
               <path fill="#4285F4"
                  d="M23.49 12.27c0-.79-.07-1.54-.19-2.27H12v4.51h6.47c-.29 1.48-1.14 2.73-2.4 3.58v3h3.86c2.26-2.09 3.56-5.17 3.56-8.82z" />
               <path fill="#34A853"
                  d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.86-3c-1.08.72-2.45 1.16-4.07 1.16-3.13 0-5.78-2.11-6.73-4.96H1.29v3.09C3.26 21.3 7.31 24 12 24z" />
               <path fill="#FBBC05"
                  d="M5.27 14.29c-.24-.72-.38-1.49-.38-2.29s.14-1.57.38-2.29V6.62H1.29A11.98 11.98 0 0 0 0 12c0 1.94.46 3.77 1.29 5.38l3.98-3.09z" />
               <path fill="#EA4335"
                  d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.31 0 3.26 2.7 1.29 6.62l3.98 3.09c.95-2.85 3.6-4.96 6.73-4.96z" />
            </svg>
         </x-links.social-link>
         <x-links.social-link class="flex-1" href="#">
            <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
               <path fill="#1877F2"
                  d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z" />
               <path fill="#fff"
                  d="M16.671 15.563l.532-3.49h-3.328V9.805c0-.956.465-1.886 1.956-1.886h1.513v-2.97s-1.374-.236-2.686-.236c-2.741 0-4.533 1.672-4.533 4.697v2.663H7.078v3.49h3.047V24a12.13 12.13 0 0 0 3.75 0v-8.437h2.796z" />
            </svg>
         </x-links.social-link>
      </div>

      <div class="text-center text-sm tracking-wide">
         <span>Have an Account? </span>
         <a href="{{ route('auth.login') }}"
            class=" capitalize text-indigo-700 font-medium cursor-pointer hover:underline underline-offset-2">back to
            login</a>
      </div>
   </x-form.form-wrapper>
@endsection