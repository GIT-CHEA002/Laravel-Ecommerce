@props(['bgColor' => 'bg-green-100'])
<span {{ $attributes->merge(['class' => ' text-black text-xs font-semibold tracking-wide  px-2 py-1 rounded-md ' . $bgColor]) }}>
  {{ $slot }}
</span>