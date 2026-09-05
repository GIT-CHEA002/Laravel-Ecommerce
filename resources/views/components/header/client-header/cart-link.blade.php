<div class=" relative flex w-fit cursor-pointer items-center
            justify-center gap-1 rounded-md border border-indigo-200
            bg-indigo-50 px-2 py-1 text-indigo-700
            transition hover:bg-indigo-100
            dark:border-slate-700 dark:bg-slate-800
            dark:text-indigo-500">
  {{-- light : text-indigo-700 , border-indigo-200 , bg-indigo-50
  dark : textt-indigo-500, border-slate-700 , bg-slate-800
  --}}
  <span class="text-sm font-medium capitalize">
    cart
  </span>
  <x-heroicon-o-shopping-cart class="h-5 w-5" />

  @auth
    <span class="absolute -right-2 -top-2 flex h-5 w-5
                                   items-center justify-center rounded-full
                                   bg-indigo-600 text-[10px] font-semibold
                                   text-white ring-2 ring-indigo-100
                                   dark:ring-slate-900 animate-pulse">
      1
    </span>
  @endauth
</div>