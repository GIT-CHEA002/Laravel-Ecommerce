<button {{ $attributes->merge([
  'class' => 'w-full
                bg-red-500/95 text-white
                text-sm uppercase
                tracking-wide
                rounded-full py-1.5
                hover:bg-red-600
                transition-colors duration-300
                shadow-sm',
  'type' => 'button'
]) }}>
  {{ $slot }}
</button>