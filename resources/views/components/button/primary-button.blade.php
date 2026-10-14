<a {{ $attributes->merge([
  'class' => ' inline-flex items-center justify-center gap-2
              px-4 lg:px-6 py-1.5
              text-sm text-white
              bg-indigo-700 dark:bg-indigo-500
              rounded-md shadow-sm
              hover:scale-[1.01] hover:shadow-md active:scale-95
              focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2
              transition-transform duration-300'
]) }}>
  {{ $slot }}
</a>