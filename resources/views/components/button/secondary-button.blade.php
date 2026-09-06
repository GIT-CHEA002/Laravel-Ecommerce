<a {{ $attributes->merge(['class' => 'inline-block px-3 md:px-4 lg:px-6 py-1.5 border border-slate-700 dark:border-slate-400 text-gray-600 dark:text-gray-300 capitalize rounded-md shadow-sm hover:scale-105 hover:bg-slate-50 dark:hover:bg-slate-800 active:scale-95 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 transition-transform duration-300']) }}>
  {{ $slot }}
</a>