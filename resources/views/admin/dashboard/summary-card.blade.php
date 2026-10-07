@props(['info' => null])
@if ($info)
  <div class="bg-white/80 dark:bg-slate-800 border rounded-md shadow-sm p-3">
    <div class="flex justify-between">
      <div>
        <h1 class="uppercase text-sm font-semibold tracking-wide">{{ $info['title'] }}</h1>
        <h1 class="py-2 text-xl tracking-wide font-bold">{{ $info['value'] }}</h1>
      </div>
      <x-dynamic-component :component="'heroicon-o-' . $info['icon']" class="w-4 h-4" />
    </div>
    <p @class([
      'mt-1 flex items-center gap-1 text-xs sm:text-sm font-medium tracking-wide',
      'text-green-600 dark:text-green-400' => $info['trend'] === 'up',
      'text-red-600 dark:text-red-400' => $info['trend'] === 'down',
    ])>
      @if ($info['trend'] === 'up')
        <x-heroicon-o-arrow-trending-up class="w-4 h-4 shrink-0" />
      @elseif ($info['trend'] === 'down')
        <x-heroicon-o-arrow-trending-down class="w-4 h-4 shrink-0" />
      @else
        <span>—</span>
      @endif
      <span class="text-sm">{{ $info['change'] }}</span>
    </p>
  </div>
@endif