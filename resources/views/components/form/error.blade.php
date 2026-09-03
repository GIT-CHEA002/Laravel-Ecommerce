@props(['error' => false])
<div>
  @if ($error)
    <span class="text-sm font-medium text-red-500 tracking-wide animate-pulse px-0.5">This field has an
      {{ $error }}
    </span>
  @endif
</div>