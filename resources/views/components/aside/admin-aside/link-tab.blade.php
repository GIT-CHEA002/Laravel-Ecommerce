@props(['active' => false, 'icon' => null, 'name' => null])
<a {{ $attributes->merge([
  'class' => 'w-full inline-flex items-center gap-2 font-bold tracking-wider text-sm sm:text-sm md:text-base px-2 md:px-4 lg:px-6 py-1.5 rounded-md hover:scale-[1.01] hover:shadow-sm transition-all duration-300 '
    . ($active ? 'bg-indigo-700 text-white/90 dark:bg-indigo-500' : 'text-black dark:text-white hover:bg-indigo-700 dark:hover:bg-indigo-500 hover:text-white/90  hover:scale-[1.01]')
]) }}>
  @if ($icon)
    <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-5 h-5" />
  @endif
  @if ($name)
    <span class="text-sm">{{ $name }}</span>
  @endif
</a>