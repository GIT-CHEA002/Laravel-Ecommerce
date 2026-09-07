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
      'active' => request()->is('client/product'),
    ],
    [
      'href' => '/client/categories',
      'icon' => 'squares-2x2',
      'name' => 'Categories',
      'active' => request()->is('client/categories'),
    ],
    [
      'href' => '/client/trending',
      'icon' => 'squares-2x2',
      'name' => 'Trending',
      'active' => request()->is('client/trending'),
    ],
  ];
@endphp
<header x-data="{isSidebarOpen : false}" {{ $attributes->merge([
  'class' => 'sticky top-0 z-50 max-w-7xl px-4 py-4 sm:px-8 md:px-12 md:py-6
           bg-indigo-100 dark:bg-slate-900 shadow-md overflow-hidden'
]) }}>
  <nav class="flex items-center justify-between">
    <a href="/" class="drop-shadow-md inline-flex items-center gap-2 text-sm font-extrabold
                   capitalize tracking-widest text-indigo-700
                   dark:text-indigo-500 md:text-base lg:text-lg">
      <x-heroicon-o-shopping-bag class="h-6 w-6" />
      StoreFront
    </a>
    {{-- desktop links --}}
    <x-header.client-header.desktop-links :links="$links" />
    <div class="flex items-center justify-end gap-4">
      <x-form.form class="md:block hidden">
        <x-header.client-header.search-form-field />
      </x-form.form>
      <x-shared.toggle-theme class="hidden md:block" />
      <x-header.client-header.cart-link />
      {{-- user sections --}}
      @auth
        <div class="cursor-pointer px-0.5">
          <x-heroicon-o-user class="h-6 w-6" />
        </div>
      @endauth
      {{-- bar to get the mobile menu --}}
      <button @click="isSidebarOpen = !isSidebarOpen"
        class="h-6 w-6 block md:hidden text-indigo-700 dark:text-indigo-500 cursor-pointer">
        <x-heroicon-o-bars-3 />
      </button>
      <x-header.client-header.mobile-sidebar-links :links="$links" />
    </div>
  </nav>
</header>