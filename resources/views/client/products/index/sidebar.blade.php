<x-form.form method="GET" action="{{ route('products.index') }}">
  <div class="md:self-start md:sticky top-12 md:top-24 md:col-span-1 lg:col-span-1 pe-2">
    {{-- Category filter --}}
    <div x-data="{ isCategoryOpen: $persist(false) }" class="border-b border-indigo-700 dark:border-indigo-500 py-4">
      <div class="flex justify-between">
        <h1 class="font-bold text-lg tracking-wide uppercase">Category</h1>
        <button type="button" class="text-indigo-700 font-bold" @click="isCategoryOpen = !isCategoryOpen">
          <x-heroicon-o-chevron-right x-show="!isCategoryOpen" class="w-5 h-5" />
          <x-heroicon-o-chevron-down x-show="isCategoryOpen" class="w-5 h-5" />
        </button>
      </div>
      <div class="space-y-5 ps-6 intro-text-color" x-show="isCategoryOpen" x-cloak
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
        @foreach ($categories as $category)
          <x-form.checkbox type="checkbox" :label="$category->name" name="category[]"
            value="{{ $category->categoried_id }}" :checked="in_array($category->categories_id, (array) request('category', []))" onchange="this.form.submit()" />
        @endforeach
      </div>
    </div>

    {{-- Price range filter --}}
    <div x-data="{ priceValue: 400 }" class="border-b border-indigo-700 dark:border-indigo-500 py-4">
      <h1 class="text-base tracking-wide uppercase">Price range</h1>
      <div class="py-2">
        <input x-model="priceValue" type="range" name="price_range" id="price_range" min="10" max="10000" step="100"
          class="w-full h-1 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600
                                                                                                               [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:h-3 [&::-webkit-slider-thumb]:w-3
                                                                                                               [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-indigo-600 [&::-webkit-slider-thumb]:ring-4
                                                                                                               [&::-webkit-slider-thumb]:transition-all
                                                                                                               [&::-moz-range-thumb]:border-none [&::-moz-range-thumb]:h-3 [&::-moz-range-thumb]:w-3
                                                                                                               [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-indigo-600 [&::-moz-range-thumb]:ring-4
                                                                                                               [&::-moz-range-thumb]:transition-all" />
        <div class="flex justify-between items-center tracking-wide">
          <span>$10</span>
          <span x-text="'$' + priceValue"></span>
          <span>$10,000+</span>
        </div>
      </div>
    </div>

    {{-- Rating filter --}}
    <div class="border-b border-indigo-700 dark:border-indigo-500 py-4">
      <h1 class="text-base tracking-wide uppercase">Rating</h1>
      <x-shared.rating-star color="text-amber-600" />
    </div>

    {{-- Clear filters --}}
    <div class="py-4">
      <x-button.primary-button href="#" class="w-full justify-center capitalize">
        Clear Filter
      </x-button.primary-button>
    </div>
  </div>
</x-form.form>