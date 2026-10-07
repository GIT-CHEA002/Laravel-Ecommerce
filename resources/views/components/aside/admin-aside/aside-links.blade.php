@props(['links' => null])
<nav {{ $attributes->merge(['class' => 'pt-6 space-y-4 flex-1']) }}>
  @if ($links)
    @foreach ($links as $link)
      <x-aside.admin-aside.link-tab href="{{ $link['href'] }}" :name="$link['name']" :icon="$link['icon']"
        :active="$link['active']" />
    @endforeach
  @endif

</nav>