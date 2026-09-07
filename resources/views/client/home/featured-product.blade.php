<div class="py-8 default-padding h-fit border-b border-indigo-700 dark:border-indigo-500">
  <x-shared.section-header class="text-center">Featured Products</x-shared.section-header>
  <x-shared.intro-text class="text-center">Shop by department for top-tier goods.</x-shared.intro-text>
  <div class="py-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 auto-rows-auto ">
    @foreach ([1, 2, 3, 4, 5, 7, 8, 9] as $num)
      <div
        class="bg-indigo-50/90 dark:bg-slate-900/90 border border-indigo-700 rounded-md overflow-hidden h-full flex flex-col">
        <div class="h-1/2 p-3">
          <img src="https://picsum.photos/seed/electronics/800/600" alt="Electronics category"
            class="h-full w-full rounded-md object-cover hover:scale-105 transition-transform duration-300 cursor-pointer">
        </div>
        <div class="h-1/2 p-3 flex flex-col justify-between">
          <div class="block">
            {{-- categories --}}
            <span class="intro-text-color font-semibold tracking-wide text-sm">Electronics</span>
            {{-- title --}}
            <h2 class="text-base md:text-lg font-bold text-slate-800 dark:text-white tracking-wide">
              Quantum Smartwatch Pro
            </h2>
          </div>
          {{-- rating star --}}
          <x-shared.rating-star />
          <div class=" py-2 flex justify-between items-center">
            <span class="font-bold  tracking-wide">$259 </span>
            <x-button.primary-button href="#">
              <span>Add</span>
              <x-heroicon-o-shopping-cart class="w-4 h-4" />
            </x-button.primary-button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>