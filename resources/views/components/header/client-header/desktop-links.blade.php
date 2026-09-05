<div class="me-8 hidden md:flex flex-1 justify-center gap-6">
  <x-header.client-header.nav-link href="/" :active="request()->is('/')">
    Home
  </x-header.client-header.nav-link>
  <x-header.client-header.nav-link href="/client/product" :active="request()->is('client/product')">
    Shop
  </x-header.client-header.nav-link>
  <x-header.client-header.nav-link href="/client/categories" :active="request()->is('client/categories')">
    Categories
  </x-header.client-header.nav-link>
</div>