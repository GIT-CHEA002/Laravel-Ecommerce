@props(['product', 'badgeTag' => 'New', 'target' => '#'])
<div
  class=" min-w-64 sm:p-4  md:p-0 bg-indigo-50/90 dark:bg-slate-900/90 border border-indigo-700 rounded-md overflow-hidden h-full flex flex-col">
  <div class="aspect-[4/3] p-3 relative group">
    <a href="{{ $target }}" class="block h-full w-full relative">
      <img {{-- src="{{ $product->isPrimaryImage() }}" for the real image path --}} src="https://picsum.photos/500/400"
        alt="{{ $product->name ?? 'Electronics category' }}"
        class="h-full w-full rounded-md object-cover group-hover:scale-105 transition-transform duration-300 cursor-pointer">

      {{-- badge --}}
      <div class="absolute top-3 left-3 z-10">
        <x-shared.badge-tag bgColor="bg-green-100">{{ $badgeTag }}</x-shared.badge-tag>
      </div>
      {{-- hover overlay --}}
      <div
        class="p-3 w-full h-full absolute inset-0 flex items-end bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <span class="text-wrap text-white text-sm font-medium">Click the picture to view details</span>
      </div>
    </a>
    {{-- wishlist button: sibling of <a>, not nested inside it --}}
      <button
        class="text-black absolute top-3 right-3 z-20 bg-indigo-100 rounded-full p-1.5 shadow hover:bg-blue-100 transition-colors">
        <x-heroicon-o-heart class="w-4 h-4" />
      </button>
  </div>
  <div class="flex-1 p-3 flex flex-col justify-between">
    <div class="block">
      {{-- category --}}
      <span class="intro-text-color font-semibold tracking-wide text-sm">{{ $product->category->name }}</span>
      {{-- title --}}
      <h2 class="text-base font-bold text-slate-800 dark:text-white tracking-wide line-clamp-2">
        {{ $product->name }}
      </h2>
    </div>
    {{-- rating + sale badge --}}
    <div class="flex items-center justify-between border-b-2 pb-2">
      <x-shared.rating-star class="gap-0 space-x-0.5" color="text-amber-500" :count="60" />
      <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-500">Sale</x-shared.badge-tag>
    </div>

    {{-- price --}}
    <div class="py-3 flex justify-between items-center">
      <div class="block">
        <span class="text-xl font-bold tracking-wide">${{ number_format($product->price, 2) }}</span>
        <span class="opacity-75 text-sm font-bold tracking-wide line-through">
          ${{ number_format($product->price + 50, 2) }}
        </span>
      </div>

      <x-button.primary-button href="#">
        <span>Add</span>
        <x-heroicon-o-shopping-cart class="w-4 h-4" />
      </x-button.primary-button>
    </div>
  </div>
</div>