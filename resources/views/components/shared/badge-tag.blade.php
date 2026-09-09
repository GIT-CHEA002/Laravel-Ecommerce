@props(['bgColor' => 'bg-green-100', 'textColor' => 'text-green-600'])
<span {{ $attributes->merge(['class' => $textColor . ' text-xs font-semibold tracking-wide  px-2 py-1 rounded-md ' . $bgColor]) }}>
  {{ $slot }}
</span>