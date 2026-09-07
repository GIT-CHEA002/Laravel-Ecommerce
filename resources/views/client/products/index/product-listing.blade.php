<div class="md:col-span-2 lg:col-span-3">
  <x-shared.section-header class="py-3 font-bold text-indigo-700 dark:text-indigo-500">Trending
    Product</x-shared.section-header>
  <div class=" flex overflow-x-auto sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach ($products as $product)
    <x-card.secondary-card-style :product="$product" class="flex-shrink-0 w-64 sm:w-auto" />
    @endforeach
  </div>
  <div class="mt-8">
    {{ $products->links() }}
  </div>
</div>