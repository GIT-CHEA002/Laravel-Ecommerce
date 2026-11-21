@props(['label', 'name', 'defaultText' => 'text-sm md:text-base'])
<label for="{{ $name }}" {{$attributes->merge(['class' => ' tracking-wide font-semibold ' . $defaultText]) }}>
  {{ $label }}
</label>