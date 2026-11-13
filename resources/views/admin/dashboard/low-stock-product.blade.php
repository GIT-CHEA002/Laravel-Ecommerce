{{-- low stock alerts --}}
<div class="flex-1 px-4 py-6 bg-white border rounded-md shadow-md dark:bg-slate-800">
  {{-- alert title --}}
  <div class="flex justify-between">
    <h1 class="font-semibold tracking-wide capitalize">low stock alerts</h1>
    <x-heroicon-s-exclamation-triangle class="w-5 h-5 text-red-500 animate-pulse" />
  </div>
  {{-- low stock product list --}}
  <div class="block pt-3 space-y-4">
    {{-- card row --}}
    @foreach ($lowStockProduct as $product)
      <div class="flex items-center justify-between">
        {{-- image --}}
        <div class="w-10 h-10 overflow-hidden border rounded-md shadow-sm">
          <img src="{{ $product->productImages?->first()?->image_url ?: 'https://placehold.co/200x300?text=No+Image' }}"
            alt="#image of the product" class="object-cover w-full h-full">
        </div>
        {{-- text --}}
        <div class="flex flex-col justify-between flex-1 leading-none ps-2">
          <h1 class="text-sm line-clamp-1">{{ $product->name }}</h1>
          <h2 class="text-sm">$ {{ number_format($product->price, 2) }}</h2>
        </div>
        {{-- status --}}
        @if ($product->stock_quantity >= 5 && $product->stock_quantity <= 10)
          <x-shared.badge-tag bgColor="bg-amber-100" textColor="text-amber-500">{{ $product->stock_quantity }}
            left</x-shared.badge-tag>
        @else
          <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-500">{{ $product->stock_quantity }}
            left</x-shared.badge-tag>
        @endif
      </div>
    @endforeach
  </div>
</div>