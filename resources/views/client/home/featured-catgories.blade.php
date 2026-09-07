<div class="h-fit bg-white dark:bg-slate-900 default-padding ">
  <x-shared.section-header>Featured Categories</x-shared.section-header>
  <x-shared.intro-text>Shop by department for top-tier goods.</x-shared.intro-text>
  {{-- data --}}
  <div
    class=" py-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 auto-rows-[220px] sm:auto-rows-[260px] md:auto-rows-[300px] lg:auto-rows-[340px] ">
    <!-- #region -->
    @foreach ($featuredCategories as $category)
      <div class="relative z-40 bg-indigo-100 rounded-md overflow-hidden ">
        <img src="https://picsum.photos/800/600" alt="{{ $category->name }}"
          class="h-full w-full object-cover hover:scale-105 transition-transform duration-300 cursor-pointer">
        <div class="absolute z-40 bottom-5 left-5">
          <h1 class=" text-xl md:text-2xl font-bold text-white tracking-wide">{{$category->name}}</h1>
          <p class="text-white text-xs sm:text-base">{{ $category->slug }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>