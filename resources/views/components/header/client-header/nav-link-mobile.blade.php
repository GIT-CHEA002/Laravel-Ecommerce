@props(['active' => false, 'icon', 'name'])
<a {{ $attributes->merge([
  'class' => ' cursor-pointer flex items-center gap-2 rounded capitalize text-xs sm:text-sm md:text-base py-3 px-2 font-semibold tracking-wide leading-none transition-all ease-in-out ' . ($active ? 'border-l-2 text-indigo-700 bg-indigo-50 dark:text-indigo-500 border-indigo-700  dark:border-indigo-500' :
    'hover:text-indigo-700/90 hover:bg-indigo-50 dark:hover:bg-white/5
hover:border-l-2 hover:border-indigo-700 dark:hover:border-indigo-500 dark:hover:text-indigo-500/90')
]) }}>
  <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-5 h-5" />
  <span>
    {{ $name }}
  </span>
</a>