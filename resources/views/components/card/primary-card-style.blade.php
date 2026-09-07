@props(['product', 'badgeTag'])
<div
  class="bg-indigo-50/90 dark:bg-slate-900/90 border border-indigo-700 rounded-md overflow-hidden h-full flex flex-col">
  <div class="h-1/2 p-3 relative">
    <img {{-- src="{{ $product->isPrimaryImage() }}" for the real image path--}} src="https://picsum.photos/500/400"
      alt="{{ $product->name ?? 'Electronics category' }}"
      class="h-full w-full rounded-md object-cover hover:scale-105 transition-transform duration-300 cursor-pointer">
    <div class=" absolute top-3 right-4">
      <x-shared.badge-tag bgColor="bg-green-100">{{$badgeTag}}</x-shared.badge-tag>
    </div>
  </div>
  <div class="h-1/2 p-3 flex flex-col justify-between">
    <div class="block">
      {{-- categories --}}
      <span class="intro-text-color font-semibold tracking-wide text-sm">{{ $product->category->name }}</span>
      {{-- title --}}
      <h2 class="text-base sm:text-lg md:text-xl font-bold text-slate-800 dark:text-white tracking-wide">
        {{ $product->name }}
      </h2>
    </div>
    {{-- rating star --}}
    <x-shared.rating-star />
    <div class=" py-2 flex justify-between items-center">
      <span class="font-bold  tracking-wide">{{ number_format($product->price, 2) }}$ </span>
      <x-button.primary-button href="#">
        <span>Add</span>
        <x-heroicon-o-shopping-cart class="w-4 h-4" />
      </x-button.primary-button>
    </div>
  </div>

</div>