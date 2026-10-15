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
        <x-shared.confirm-dialog show="isLogoutDialog" title="Confirm Logout"
          message="You need to be sign in again after log out ? " action="{{ route('logout-user') }}"
          confirmText="Log Out" />
      @endauth
      @guest
        <a href="{{ route('login-user') }}"
          class="flex w-fit items-center justify-center gap-1 rounded-md border border-indigo-200 bg-indigo-50 px-2 py-1 text-indigo-700 transition hover:bg-indigo-100 dark:border-slate-700 dark:bg-slate-800 dark:text-indigo-500">
          <span class="text-xs tracking-wide">Login</span>
          <x-heroicon-o-user class="h-5 w-5" />
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