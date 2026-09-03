<button {{ $attributes->merge([
  'class' => 'w-full mt-3
                                        bg-indigo-700/95 text-white
                                          text-sm  uppercase
                                        tracking-wide
                                        rounded-full py-1.5 
                                        hover:bg-indigo-700
                                        transition-colors duration-300
                                        shadow-sm',
  'type' => 'submit'
]) }}>
  {{ $slot }}
</button>