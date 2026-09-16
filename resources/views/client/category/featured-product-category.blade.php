<div class="block">
  <x-shared.section-header>Primary Departments</x-shared.section-header>
  <x-shared.intro-text class="text-sm">Direct navigation through structured parent
    collections</x-shared.intro-text>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 py-3">
    @foreach ($products as $product)
      @include('client.category.featured-product-category-card', ['product' => $product,])
    @endforeach
  </div>
  <div class="py-4">
    {{$products->links()}}
  </div>
</div>