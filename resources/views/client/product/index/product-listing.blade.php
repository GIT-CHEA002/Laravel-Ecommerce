<div class="md:col-span-2 lg:col-span-3 auto-rows-auto">
  <x-shared.section-header class="py-3 font-bold text-indigo-700 dark:text-indigo-500">
    Trending Product
  </x-shared.section-header>
  <div class=" pb-2 flex flex-nowrap items-stretch overflow-x-auto sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-5 ">
    @foreach ($products as $product)
      <div class="flex-shrink-0 w-64 sm:w-auto">
        @include('client.product.index.product-listing-card', [
          'product' => $product,
          'target' => route('product.show', $product),
          'badgeTag' => 'New',
        ])
      </div>
    @endforeach
  </div>
  <div class="mt-8">
    {{ $products->links() }}
  </div>
</div>