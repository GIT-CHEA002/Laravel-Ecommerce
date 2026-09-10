@props(['product', 'badgeTag' => 'New', 'target' => '#'])
<div {{ $attributes->merge(['class' => 'bg-indigo-50/90 dark:bg-slate-900/90 border border-indigo-700 rounded-md overflow-hidden h-full flex flex-col']) }}>
  <div class="h-1/2 px-7 pt-7 relative">
    <img src="https://picsum.photos/500/400" alt="{{ $product->name ?? 'Electronics category' }}"
      class="h-full w-full rounded-md object-cover hover:scale-105 transition-transform duration-700 cursor-pointer">
    <div class="absolute top-8 right-8">
      <x-shared.badge-tag bgColor="bg-white" textColor="text-black" rounded="rounded-full">128</x-shared.badge-tag>
    </div>
  </div>
  <div class="h-1/2 px-7 py-4 flex flex-col justify-between">
    <div class="block border-b pb-1">
      {{-- title --}}
      <h2 class="text-base sm:text-lg md:text-xl font-bold text-slate-800 dark:text-white tracking-wide">
        {{ $product->name }}
      </h2>
      {{-- categories --}}
      <h1 class="font-semibold tracking-wide text-sm">
        <span>{{ $product->category->name }}</span>,
      </h1>
      <p class="text-justify">{{ Str::words($product->description, 15, '...') }}</p>
    </div>
    <div class="py-2">
      <x-links.secondary-link
        href="{{ route('category.index', ['category' => $product->category->categories_id]) }}">Explore
        departments</x-links.primary-link>
    </div>
  </div>
</div>