{{-- resources/views/components/form/select.blade.php --}}
@props([
  'name',
  'options' => [],          // ['value' => 'Label']
  'placeholder' => null,    // e.g. "All Categories"
  'label' => false,
  'selected' => null,
])

@php($current = old($name, request($name, $selected)))

<div>
  @if ($label)
    <x-form.label :$label :$name />
  @endif
  <div {{ $attributes->only('class')->class(['relative inline-block']) }}>
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->except('class')->class([
  'appearance-none outline-none cursor-pointer',
  'w-full px-4 py-2 pr-10 text-sm rounded-lg',
  'text-slate-900 dark:text-indigo-50',
  'bg-white dark:bg-slate-800',
  'border border-slate-300 dark:border-slate-700',
  'focus:border-indigo-600 dark:focus:border-indigo-600',
  'transition-colors duration-300',
]) }}>
      @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
      @endif

      @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected((string) $current === (string) $value)>
          {{ $text }}
        </option>
      @endforeach
    </select>

    <x-heroicon-o-chevron-down
      class="absolute right-3 top-1/2 -translate-y-1/2 size-4 text-slate-500 pointer-events-none" />
  </div>

  <x-form.error :error="$errors->first($name)" />
</div>