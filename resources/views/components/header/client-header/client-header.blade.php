@php
  $links = [
    [
      'href' => '/',
      'icon' => 'home',
      'name' => 'Home',
      'active' => request()->is('/'),
    ],
    [
      'href' => '/client/product',
      'icon' => 'shopping-bag',
      'name' => 'Shop',
      'active' => request()->is('client/product') || preg_match('#^client/product/\d+$#', request()->path()),
    ],
    [
      'href' => '/client/category',
      'icon' => 'squares-2x2',
      'name' => 'Categories',
      'active' => request()->is('client/category'),
    ],
    [
      'href' => '/client/product/trending',
      'icon' => 'squares-2x2',
      'name' => 'Trending',
      'active' => request()->is('client/product/trending'),
    ],
  ];
@endphp
<header x-data="{isSidebarOpen : false, isLogoutDialog:false}" {{ $attributes->merge([
  'class' => 'sticky top-0 z-50 max-w-7xl default-padding
           bg-indigo-100 dark:bg-slate-900 shadow-md overflow-hidden'
]) }}>
  <nav class="flex items-center justify-between">
    <a href="/" class="drop-shadow-md inline-flex items-center gap-2 text-sm font-extrabold
                   capitalize tracking-wide text-indigo-700
                   dark:text-indigo-500 md:text-base lg:text-lg">
      <x-heroicon-o-shopping-bag class="h-6 w-6" />
      LaraStore
    </a>
    {{-- desktop links --}}
    <x-header.client-header.desktop-links :links="$links" />
    <div class="flex items-center justify-end gap-4">
      {{-- search form --}}
      <x-form.form class="md:flex my-auto hidden">
        <x-header.client-header.search-form-field />
      </x-form.form>
      <x-shared.toggle-theme class="hidden md:block" />
      <x-header.client-header.cart-link href="/client/cart" />

      {{-- user sections --}}
      @auth
        <button type="button" @click="isLogoutDialog = true" class="relative flex w-fit cursor-pointer items-center justify-center gap-1
             rounded-md border border-indigo-200 bg-indigo-50 px-2 py-1 text-indigo-700
             transition hover:bg-indigo-100
             dark:border-slate-700 dark:bg-slate-800 dark:text-indigo-500">
          <span class="text-xs tracking-wide">Log out</span>
          <x-heroicon-o-user class="h-5 w-5 text-indigo-700 dark:text-indigo-500" />
        </button>

        {{-- full-screen overlay --}}
        <div x-show="isLogoutDialog" x-cloak @keydown.escape.window="isLogoutDialog = false"
          class="fixed inset-0 z-[100] flex items-center justify-center p-4">

          {{-- backdrop --}}
          <div x-show="isLogoutDialog" x-transition.opacity @click="isLogoutDialog = false"
            class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

          {{-- panel --}}
          <div x-show="isLogoutDialog" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" role="dialog" aria-modal="true" class="relative w-full max-w-sm rounded-xl border border-indigo-200 bg-indigo-50
                  p-6 shadow-xl dark:border-slate-700 dark:bg-slate-900">

            <h2 class="text-lg font-bold text-indigo-700 dark:text-indigo-500">Log out?</h2>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
              You'll need to sign in again to access your account.
            </p>

            <div class="mt-6 flex justify-end gap-3">
              <button type="button" @click="isLogoutDialog = false" class="cursor-pointer rounded-md px-3 py-1.5 text-sm font-semibold text-slate-700
                   transition hover:bg-indigo-100 dark:text-slate-300 dark:hover:bg-slate-800">
                Cancel
              </button>

              <x-form.form method="POST" action="{{ route('logout-user') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold
                     text-white transition hover:bg-red-700">
                  Yes, log out
                </button>
              </x-form.form>
            </div>
          </div>
        </div>
      @endauth
      @guest
        <a href="/auth/login" class="relative flex w-fit cursor-pointer items-center
                                                              justify-center gap-1 rounded-md border border-indigo-200
                                                              bg-indigo-50 px-2 py-1 text-indigo-700
                                                              transition hover:bg-indigo-100
                                                              dark:border-slate-700 dark:bg-slate-800
                                                              dark:text-indigo-500">
          <span class="text-xs tracking-wide">Login</span>
          <x-heroicon-o-user class="h-5 w-5 text-indigo-700 dark:text-indigo-500" />
        </a>
      @endguest
      {{-- bar to get the mobile menu --}}
      <button @click="isSidebarOpen = !isSidebarOpen"
        class="h-6 w-6 block md:hidden text-indigo-700 dark:text-indigo-500 cursor-pointer">
        <x-heroicon-o-bars-3 />
      </button>
      <x-header.client-header.mobile-sidebar-links :links="$links" />
    </div>
  </nav>
</header>