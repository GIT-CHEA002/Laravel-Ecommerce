<a {{ $attributes->merge([
  'class' =>
    'text-sm rounded-md border border-slate-300 dark:border-slate-700 hover:border-indigo-700  dark:hover:border-indigo-500
     bg-white dark:bg-slate-800 transition-all duration-300 hover:scale-105 flex justify-center items-center px-2 py-1.5'
]) }}>
  {{ $slot }}
</a>