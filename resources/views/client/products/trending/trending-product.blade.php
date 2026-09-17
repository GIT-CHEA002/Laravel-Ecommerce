<div class="py-5">
  <x-shared.section-header>Fast-Moving Inventory</x-shared.section-header>
  <x-shared.intro-text>
    Real-time demand tracking calculated by sales volume, views, and live cart
    events.
  </x-shared.intro-text>
  <div
    class="py-5 flex flex-nowrap overflow-x-auto sm:grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 items-stretch ">
    @foreach ($trendingProduct as $product)
      @include('client.products.trending.trending-product-card', [
        'product' => $product,
        'target' => route('product.show', $product),
        'badgeTag' => $product->slug,
      ])
    @endforeach
  </div>
  <div class="py-4">
    {{ $trendingProduct->links() }}
  </div>
</div>