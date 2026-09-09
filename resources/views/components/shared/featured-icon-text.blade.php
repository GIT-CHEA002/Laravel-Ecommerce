@props(['icon' => 'truck', 'iconColor' => 'text-green-700'])
<div {{ $attributes->merge(['class' => 'flex items-center justify-start gap-1']) }}>
  <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-4 h-4 {{ $iconColor }}" />
  <span class="capitalize font-semibold tracking-wide">{{ $slot }}</span>
</div>