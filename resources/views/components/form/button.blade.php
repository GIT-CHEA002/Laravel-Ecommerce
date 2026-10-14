<button {{ $attributes->merge([
  'class' => 'inline-flex items-center justify-center gap-2
              w-full px-4 lg:px-6 py-1.5
              text-sm uppercase tracking-wide text-white
              bg-indigo-700/95 hover:bg-indigo-700
              rounded-full shadow-sm
              transition-colors duration-300',
  'type' => 'submit'
]) }}>
  {{ $slot }}
</button>