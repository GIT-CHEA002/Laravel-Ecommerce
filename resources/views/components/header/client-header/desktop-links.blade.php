@props(['links'])
<div {{ $attributes->merge(['class' => 'me-8 hidden md:flex flex-1 justify-center gap-6']) }}>
  @foreach ($links as $link)
    <x-header.client-header.nav-link href="{{ $link['href'] }}" :active="$link['active']">
      {{$link['name']}}
    </x-header.client-header.nav-link>
  @endforeach
</div>