{{-- resources/views/components/form/checkbox.blade.php --}}
@props(['type' => 'checkbox', 'name', 'label', 'checked' => false])
<div class="flex justify-start items-center gap-2">
  <input type="{{ $type }}" name="{{ $name }}" @checked($checked) {{ $attributes->merge(['class' => 'border-indigo-700 cursor-pointer']) }} />
  @if ($label)
    <x-form.label :label="$label" :name="$name" />
  @endif
</div>