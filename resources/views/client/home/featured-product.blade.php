<div class="py-8 default-padding h-fit border-b border-indigo-700 dark:border-indigo-500">
  <x-shared.section-header class="text-center">Featured Products</x-shared.section-header>
  <x-shared.intro-text class="text-center">Shop by department for top-tier goods.</x-shared.intro-text>
  <div
    class="py-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 auto-rows-auto sm:auto-rows-[250px] md:auto-rows-[300px] lg:auto-rows-[340px] ">
    @foreach ($featuredProduct as $product)
      <x-card.primary-card-style :product="$product" :badgeTag="$product->slug" />
    @endforeach
  </div>
</div>