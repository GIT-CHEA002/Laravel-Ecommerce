<a {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 px-3 md:px-4 lg:px-6 py-1.5 bg-indigo-700 dark:bg-indigo-500 text-white rounded-md shadow-sm hover:scale-105 hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition-transform duration-300']) }}>
  {{ $slot }}
</a>