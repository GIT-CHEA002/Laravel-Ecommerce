@props(['width' => 'w-full'])

<a {{ $attributes->merge([
  'class' => 'inline-flex items-center ' . $width . ' gap-0.5 intro-text-color underline underline-offset-2 hover:text-indigo-700 dark:hover:text-indigo-500 transition-colors duration-300'
]) }}>
  {{ $slot }}
</a>