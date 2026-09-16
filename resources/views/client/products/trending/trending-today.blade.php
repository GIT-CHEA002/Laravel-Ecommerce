<div
  class="my-4 block h-fit items-start justify-between gap-6 rounded-md border bg-white p-4 dark:border-slate-600 dark:bg-slate-800 md:flex">
  {{-- Product image --}}
  <div class="w-full shrink-0 overflow-hidden p-3 sm:p-4 md:w-1/3 md:p-5 lg:p-4">
    <img src="https://picsum.photos/600/600" alt="Aura Pro Wireless Headphones"
      class="aspect-square h-full w-full rounded-md border border-slate-400 object-cover dark:border-slate-600">
  </div>
  {{-- Product information --}}
  <div class="h-fit flex-1">
    {{-- Product badges --}}
    <div class=" sm:py-3 lg:py-0 block items-center justify-between space-y-2 pb-2 sm:flex sm:space-y-0">
      <h1 class="w-fit text-sm font-medium uppercase tracking-wide text-indigo-700 dark:text-indigo-500">
        Special Edition Release
      </h1>

      <h1 class="w-fit rounded-full bg-red-100 px-2 text-xs font-medium tracking-wide text-red-700 dark:text-red-500">
        Only 14 units remaining in stock
      </h1>
    </div>

    {{-- Product name --}}
    <x-shared.section-header>
      Aura Pro Wireless Headphones — Indigo Edition
    </x-shared.section-header>

    {{-- Rating --}}
    <div class="items-center justify-start gap-2 space-y-2 py-1 md:flex md:space-y-0">
      <x-shared.rating-star count="1,420 verified buyer ratings" color="text-amber-500" />
      <span class="hidden md:block">|</span>
      <x-shared.featured-icon-text class="text-green-600" icon="arrow-trending-up">
        99% Satisfaction
      </x-shared.featured-icon-text>
    </div>

    {{-- Description --}}
    <x-shared.intro-text class="border-b py-4 text-justify">
      Custom-tuned 45mm neodymium drivers, active planar acoustic chamber,
      and 60-hour hyper-charge battery. Crafted specifically for master
      engineers, creators, and discerning audiophiles.
      Custom-tuned 45mm neodymium drivers, active planar acoustic chamber,
      and 60-hour hyper-charge battery. Crafted specifically for master
      engineers, creators, and discerning audiophiles.
    </x-shared.intro-text>

    {{-- Price and actions --}}
    <div class="block items-center justify-between gap-2 py-2 md:flex">
      <div>
        <div class="w-fit space-x-2">
          <span class="text-3xl font-bold tracking-wide">
            ${{ number_format(299, 2) }}
          </span>
          <span class="intro-text-color line-through">
            ${{ number_format(349, 2) }}
          </span>
          <span class="rounded bg-green-100 px-2 text-xs font-bold text-green-700">
            Save $50
          </span>
        </div>
        <x-shared.intro-text>
          Includes complimentary magnetic charging stand ($49 value)
        </x-shared.intro-text>
      </div>

      <div class="block items-center justify-between gap-4 space-y-4 sm:flex sm:space-y-0">
        <x-button.quantity-selector class="h-fit" />
        <x-button.primary-button href="#" class="w-full justify-center text-nowrap text-xs md:w-fit">
          <span class="text-sm">Claim Yours / Add to Cart</span>
        </x-button.primary-button>
      </div>
    </div>
  </div>
</div>