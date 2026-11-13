<div
  class="default-padding grid grid-cols-1 md:grid-cols-2 items-center place-items-center gap-8 min-h-screen border-b border-indigo-700 dark:border-indigo-500">

  {{-- Text side: vertically centered --}}
  <div class="md:pe-6 lg:pe-12 flex flex-col justify-center">
    <x-shared.hero-title>Elevate Your Lifestyle with Premium Essentials</x-shared.hero-title>
    <x-shared.intro-text>
      Discover our curated collection of high-quality products designed to blend seamlessly
      into your modern life. Precision engineering meets sophisticated style.
    </x-shared.intro-text>
    <div class="py-3 gap-5 space-y-4 md:space-y-0 block md:flex">
      <x-button.primary-button href="/client/product" class="w-full md:w-fit justify-center">
        Shop Now
        <x-heroicon-o-chevron-right class="h-4 w-4" />
      </x-button.primary-button>
      <x-button.secondary-button href="/client/category" class="w-full md:w-fit text-center">
        Explore collection
      </x-button.secondary-button>
    </div>
  </div>

  {{-- Image side: vertically centered, capped to screen height --}}
  <div class="md:ps-6 lg:ps-12 w-full flex items-center justify-center">
    <div class="w-full bg-blue-300 rounded-md overflow-hidden max-h-[80vh]">
      <img src="https://placehold.co/200x300?text=No+Image" alt="Premium lifestyle essentials"
        class="w-full h-full max-h-[80vh] object-cover hover:scale-105 transition-transform duration-300"
        loading="lazy">
    </div>
  </div>
</div>