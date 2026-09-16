@props([
  'bgColor' => 'bg-green-100',
  'textColor' => 'text-green-600',
  'rounded' => 'rounded-md',
])

<span {{ $attributes->merge([
  'class' => "$textColor text-xs font-normal tracking-wide px-2 py-0.5  $rounded $bgColor",
]) }}>
  {{ $slot }}
</span>