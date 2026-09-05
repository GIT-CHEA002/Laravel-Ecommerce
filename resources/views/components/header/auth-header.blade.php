<header
  class="sticky top-0 z-50 max-w-7xl px-4 sm:px-8 md:px-12 py-4 md:py-6 bg-indigo-100 dark:bg-slate-900 shadow-md">
  <nav class=" flex items-center justify-between ">
    <a href="/"
      class="capitalize tracking-widest text-indigo-700 dark:text-indigo-500 text-sm md:text-base lg:text-lg font-extrabold">
      LuxeCommerce </a>

    <div class="flex-1 flex justify-end items-center">
      @auth
        <x-form.form action="{{ route('logout-user') }}" method="DELETE" class="flex items-center">
          <button type="submit"
            class="text-sm font-medium  tracking-wide hover:underline underline-offset-2 text-red-500 dark:text-red-700 px-2">
            Log Out
          </button>
        </x-form.form>
      @endauth
      <x-shared.toggle-theme />
    </div>
  </nav>
</header>