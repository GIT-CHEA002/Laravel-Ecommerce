@props(['active' => false])
<a {{ $attributes->merge([
  'class' => 'cursor-pointer text-sm tracking-wide font-semibold border py-1 px-4 rounded-full transition-all duration-300 ' .
    ($active
      ? 'bg-indigo-700 text-white border-white dark:border-indigo-400'
      : 'border-slate-400 dark:border-slate-600 hover:bg-indigo-50 dark:hover:bg-slate-900')
]) }}>
  {{ $slot }}
</a>