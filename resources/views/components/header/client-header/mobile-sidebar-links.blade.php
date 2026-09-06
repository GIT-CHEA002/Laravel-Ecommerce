@props(['links'])
<div x-show="isSidebarOpen" x-transition:enter="transform transition ease-out duration-300"
  x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
  x-transition:leave="transform transition ease-in duration-300" x-transition:leave-start="translate-x-0"
  x-transition:leave-end="translate-x-full"
  class=" fixed right-0 top-0 h-screen overflow-scroll [&::-webkit-scrollbar]:hidden w-[300px] bg-white dark:bg-slate-900 z-50 shadow-xl border-l flex flex-col">
  {{-- header --}}
  <div class="flex px-4 py-4 sm:px-8 md:px-12 md:py-6 border-b mt-1 justify-between items-center">
    <a href="/" class="inline-flex items-center gap-2 text-sm font-extrabold
                   capitalize tracking-widest text-indigo-700
                   dark:text-indigo-500 md:text-base lg:text-lg">
      StoreFront
    </a>
    {{-- dispose btn --}}
    <button @click="isSidebarOpen = !isSidebarOpen" class="text-indigo-700 dark:text-indigo-500 font-bold">
      <x-heroicon-o-x-mark class="w-6 h-6 font-bold" />
    </button>
  </div>
  <div class="grow flex flex-col justify-between py-4 px-4 ">
    <div class="space-y-5">
      @foreach ($links as $link)
        <x-header.client-header.nav-link-mobile href="{{ $link['href'] }}" icon="{{$link['icon']}}"
          name="{{ $link['name'] }}" :active="$link['active']" />
      @endforeach
    </div>
    <div class="flex gap-4 items-center">
      <x-shared.toggle-theme class="flex-1 bg-transparent rounded-full" />
      {{-- <x-form.form method="DELETE" class="flex-1">
        <x-form.log-out-button>Log out</x-form.log-out-button>
      </x-form.form> --}}
    </div>
  </div>
</div>