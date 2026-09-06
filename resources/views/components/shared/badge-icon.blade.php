@props(['icon'])
<div {{ $attributes->merge(['class' => 'p-3 rounded-full w-fit bg-indigo-100 font-bold']) }}>
  <x-dynamic-component :component="'heroicon-s-' . $icon" class="h-8 w-8 text-indigo-700 dark:text-indigo-500" />
</div>