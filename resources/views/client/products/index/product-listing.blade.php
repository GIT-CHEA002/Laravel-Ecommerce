<div class="md:col-span-2 lg:col-span-3 auto-rows-auto">
  <x-shared.section-header class="py-3 font-bold text-indigo-700 dark:text-indigo-500">Trending
    Product</x-shared.section-header>
  <div class=" flex flex-nowrap overflow-x-auto sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:items-stretch">
    @foreach ($products as $product)
      @include('client.products.index.product-listing-card', ['product' => $product, "target" => route('product.show', $product), 'badgeTag' => 'New'])
    @endforeach
  </div>
  <div class="mt-8">
    {{ $products->links() }}
  </div>
</div>