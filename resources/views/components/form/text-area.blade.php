@props(['name', 'placeholder','value'=>null, 'row' => 4])
<textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $row }}" placeholder="{{ $placeholder }}"
  {{ $attributes->merge(['class'=>'w-full placeholder:text-xs bg-transparent outline-none resize-none tracking-wide placeholder:text-slate-400']) }}
>
{{ $value }}
</textarea>