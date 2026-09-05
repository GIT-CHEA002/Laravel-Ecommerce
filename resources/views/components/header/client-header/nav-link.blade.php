@props(['active' => false])

<a {{ $attributes->merge([
  'class' => 'font-bold text-base underline-offset-4 ' . (
    $active
    ? 'text-indigo-700 dark:text-indigo-500 underline'
    : 'cursor-pointer tracking-wide hover:underline hover:text-indigo-700 dark:hover:text-indigo-500'
  ),
]) }} aria-current="{{ $active ? 'page' : 'false' }}">
  {{ $slot }}
</a>