@props(['label' => null, 'for' => null])

<div class="w-full">
  @if ($label)
    <label @if ($for) for="{{ $for }}" @endif class="block py-0.5 text-sm font-medium tracking-wide">
      {{ $label }}
    </label>
  @endif

  <div {{ $attributes->class([
  'flex w-full gap-2 rounded border px-4 py-2 text-sm transition-colors duration-300',
  'border-slate-300 bg-white focus-within:border-indigo-700',
  'dark:border-slate-700 dark:bg-slate-800',
]) }}>
    {{ $slot }}
  </div>
</div>