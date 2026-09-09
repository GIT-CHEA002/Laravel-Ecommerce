<div class="">
  <div class="border-b-2">
    <x-shared.section-header>Related Products</x-shared.section-header>
  </div>
  <div class="grid grid-cols-4 gap-6 py-8">
    @foreach ($relatedProduct as $product)
      <x-card.tertiary-card-style :product="$product" :target="route('product.show', $product)" />
    @endforeach
  </div>
</div>