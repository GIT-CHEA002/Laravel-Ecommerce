@props(['label', 'name', 'placeholder', 'type'])
@php
  $defaults = [
    'type' => $type,
    'id' => $name,
    'name' => $name,
    'class' => 'grow
                appearance-none
                outline-none
                text-sm
                bg-transparent
                text-slate-900 dark:text-indigo-50
                placeholder:text-slate-400
                placeholder:text-xs
                dark:placeholder:text-slate-500',
    'value' => old($name),
    'placeholder' => $placeholder
  ]
@endphp
<input {{ $attributes->merge($defaults) }} />

{{-- --}}