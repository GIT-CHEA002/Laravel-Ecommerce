<div
  class="default-padding grid grid-cols-1 md:grid-cols-2 place-items-center gap-8 border-b border-indigo-700 dark:border-indigo-500">
  <div class="md:pe-6 lg:pe-12">
    <x-shared.hero-title> Elevate Your Lifestyle with Premium Essentials</x-shared.hero-title>
    <x-shared.intro-text> Discover our curated collection of high-quality products designed to blend seamlessly
      into your
      modern life. Precision engineering meets sophisticated style.</x-shared.intro-text>
    <div class="py-3 gap-5 space-y-4 md:space-y-0 block md:flex">
      <x-button.primary-button href="/client/products" class="w-full md:w-fit justify-center">
        Shop Now
        <x-heroicon-o-chevron-right class="h-4 w-4" />
      </x-button.primary-button>
      <x-button.secondary-button href="/client/categories" class="w-full md:w-fit text-center">
        Explore collection
      </x-button.secondary-button>
    </div>
  </div>
  {{-- picture of the hero sections--}}
  <div class="md:ps-6 lg:ps-12 w-full  rounded-md overflow-hidden lg:py-12">
    <img src="https://picsum.photos/id/238/800/600" alt="Premium lifestyle essentials"
      class="w-full h-full rounded-md object-cover" loading="lazy">
  </div>
</div>