@props(['count' => 0, 'total' => 0, 'color' => 'text-green-600'])
<div {{ $attributes->merge(['class' => ' gap-2 flex w-fit justify-center items-center']) }}>
  @foreach ([1, 2, 3, 4] as $num)
    <x-heroicon-s-star class="w-3 h-3 {{ $color }}" />
  @endforeach
  <x-heroicon-o-star class="w-3 h-3 {{ $color }}" />
  <span class="text-sm font-semibold tracking-wide px-0.5">(42)</span>
</div>