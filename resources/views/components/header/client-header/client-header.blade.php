<header x-data="{isSidebarOpen : false}" class="sticky top-0 z-50 max-w-7xl px-4 py-4 sm:px-8 md:px-12 md:py-6
           bg-indigo-100 dark:bg-slate-900 shadow-md">
  <nav class="flex items-center justify-between">
    <a href="/" class="inline-flex items-center gap-2 text-sm font-extrabold
                   capitalize tracking-widest text-indigo-700
                   dark:text-indigo-500 md:text-base lg:text-lg">
      <x-heroicon-o-shopping-bag class="h-6 w-6" />
      StoreFront
    </a>
    {{-- desktop links --}}
    <x-header.client-header.desktop-links />
    <div class="flex items-center justify-end gap-4">
      <x-form.form class="md:block hidden">
        <div class="flex w-fit items-center justify-center gap-1
            rounded-full border border-slate-400
            bg-indigo-50/90 px-4 py-1
            dark:border-slate-700 dark:bg-slate-800">
          <x-heroicon-o-magnifying-glass class="h-4 w-4 text-slate-600 dark:text-slate-300" />
          <input type="text" name="search" placeholder="search..." class="h-full bg-transparent text-sm tracking-wide
               text-slate-700 outline-none
               placeholder:text-slate-500
               dark:text-slate-200
               dark:placeholder:text-slate-400
               placeholder:text-sm placeholder:tracking-wide">
        </div>
      </x-form.form>
      <x-shared.toggle-theme />
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
      <div x-show="isSidebarOpen" x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class=" fixed right-0 top-0 h-screen overflow-scroll [&::-webkit-scrollbar]:hidden w-[300px] bg-white dark:bg-slate-900 z-50 shadow-xl border-l flex flex-col">
        {{-- header --}}
        <div class="flex  px-4 py-4 sm:px-8 md:px-12 md:py-6 border-b mt-1 justify-between items-center">
          <a href="/" class="inline-flex items-center gap-2 text-sm font-extrabold
                   capitalize tracking-widest text-indigo-700
                   dark:text-indigo-500 md:text-base lg:text-lg">
            StoreFront
          </a>
          {{-- dispose btn --}}
          <button @click="isSidebarOpen = !isSidebarOpen" class="text-indigo-700 dark:text-indigo-500 font-bold">
            <x-heroicon-o-x-mark class="w-6 h-6 font-bold" />
          </button>
        </div>
        <div class="py-4 px-4 space-y-4 ">

          <x-header.client-header.nav-link-mobile href="/" icon="home" name="Home" :active="request()->is('/')" />
          <x-header.client-header.nav-link-mobile href="/client/product" icon="shopping-bag" name="Shop"
            :active="request()->is('client/product')" />
          <x-header.client-header.nav-link-mobile href="/client/categories" icon="home" name="Shop"
            :active="request()->is('client/categories')" />
        </div>
        {{-- links --}}
        {{-- bottom links, search and theme --}}

      </div>

    </div>
  </nav>
</header>