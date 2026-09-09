@props(['product', 'badgeTag' => false, 'target' => '#'])
<a href="{{ $target }}" {{ $attributes->merge(['class' => 'bg-indigo-50/90 dark:bg-slate-900/90 border border-indigo-700 rounded-md overflow-hidden h-full flex flex-col']) }}>
  <div class="h-2/3 p-3 relative">
    <img {{-- src="{{ $product->isPrimaryImage() }}" for the real image path--}}
      src="https://picsum.photos/seed/{{ $product->product_id }}-{{ $product->productImages['0']->image_id }}/600/600"
      alt="{{ $product->name ?? 'Electronics category' }}"
      class="h-full w-full rounded-md object-cover hover:scale-105 transition-transform duration-300 cursor-pointer">
    <div class="absolute top-3 right-4">
      @if ($badgeTag)
        <x-shared.badge-tag bgColor="bg-green-100">{{$badgeTag}}</x-shared.badge-tag>
      @endif
    </div>
  </div>
  <div class="h-1/2 px-3 py-4 flex flex-col justify-between">
    <div class="block">
      {{-- title --}}
      <h2 class="text-base sm:text-lg md:text-xl font-bold text-slate-800 dark:text-white tracking-wide">
        {{ $product->name }}
      </h2>
      {{-- categories --}}
      <h1 class="font-semibold tracking-wide text-sm">
        <span>{{ $product->category->name }}</span>,
        <span class="intro-text-color">{{ $product->slug }}</span>
      </h1>
    </div>
    <span class="font-bold tracking-wide text-indigo-700 dark:text-indigo-500">
      {{ number_format($product->price, 2) }}$
    </span>
  </div>
</a>