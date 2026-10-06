<div class="py-8 default-padding h-fit border-b border-indigo-700 dark:border-indigo-500">
  <x-shared.section-header class="text-center">Featured Products</x-shared.section-header>
  <x-shared.intro-text class="text-center">Shop by department for top-tier goods.</x-shared.intro-text>
  <div
    class=" py-5 flex overflow-x-auto flex-nowrap sm:grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 items-stretch  ">
    @foreach ($featuredProduct as $product)
      @include('client.home.featured-product-card', [
        'product' => $product,
        'target' => route('product.show', $product),
        'badgeTag' => $product->slug,
      ])
    @endforeach
  </div>
  {{-- --}}
  <div class="py-3 flex justify-end">
    <x-links.primary-link href="{{ route('product.index') }}" width="w-fit"
      class="no-underline text-sm tracking-wide font-meduim text-indigo-700 dark:text-indigo-500  hover:underline">
      View All Products
    </x-links.primary-link>
  </div>
</div>