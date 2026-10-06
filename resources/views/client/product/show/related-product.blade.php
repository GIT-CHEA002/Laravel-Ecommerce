<div class="">
  <div class="border-b-2">
    <x-shared.section-header>Related Products</x-shared.section-header>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-8">
    @foreach ($relatedProduct as $product)
      @include('client.products.show.related-product-card', ['product' => $product, 'target' => route('product.show', $product), 'badgeTag' => 'New'])
    @endforeach
  </div>
</div>