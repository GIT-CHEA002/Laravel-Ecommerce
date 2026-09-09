<div class="rounded-md md:ps-3 flex flex-col justify-between">
  <div>
    <p class="tracking-wide text-indigo-700 text-sm font-medium">
      {{ $product->category->name }}
    </p>
    <div class="flex-1">
      <x-shared.section-header class="w-full md:w-9/12">
        {{ $product->name }}
      </x-shared.section-header>
      <div class="flex items-center justify-start md:gap-4">
        <x-shared.rating-star count="128 Reviews" color="text-amber-500" />
        <x-shared.badge-tag class="animate-pulse">
          In stock
        </x-shared.badge-tag>
      </div>
      <div class="py-2">
        <span class="text-lg md:text-xl lg:text-2xl tracking-wide font-bold text-indigo-700 dark:text-indigo-500">
          ${{ number_format($product->price, 2) }}
        </span>
      </div>

      <div class="py-2">
        <x-shared.intro-text class="text-justify">
          {{ $product->description }}
        </x-shared.intro-text>
      </div>
    </div>
  </div>
  <div class="space-y-3">
    <x-shared.featured-icon-text icon="truck">
      Free Express Shipping
    </x-shared.featured-icon-text>
    <x-shared.featured-icon-text icon="shield-check">
      2-Year Global Warranty
    </x-shared.featured-icon-text>
    <x-shared.featured-icon-text icon="clipboard-document">
      30-Day Risk-Free Returns
    </x-shared.featured-icon-text>
  </div>
  <div class="space-y-2">
    <div class="flex justify-between items-center gap-3 py-2">
      <x-button.quantity-selector name="productQuantity" />
      <div class="flex-1">
        <x-button.primary-button href="#" class="w-full justify-center">
          <x-heroicon-o-shopping-cart class="w-4 h-4" />
          <span>Add To Cart</span>
        </x-button.primary-button>
      </div>
    </div>
    <x-button.primary-button class="w-full justify-center bg-green-700 dark:bg-green-500" href="#">
      Buy Now
    </x-button.primary-button>
  </div>
</div>
@stack('scripts')