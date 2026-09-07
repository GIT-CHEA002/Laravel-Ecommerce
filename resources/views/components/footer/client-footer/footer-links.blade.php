@props(['footerSections'])
@foreach ($footerSections as $footerSection)
  <div class="block text-start">
    <h1 class="text-base font-extrabold tracking-wide">{{ $footerSection['title'] }}</h1>
    <div class="space-y-1 block tracking-wide capitalize">
      @foreach ($footerSection['links'] as $link)
        <x-links.primary-link href="#"> @isset ($link['icon'])
          <x-dynamic-component :component="$link['icon']" class="h-4 w-4" />
        @endisset {{ $link['label'] }}</x-links.primary-link>
      @endforeach
    </div>
  </div>
@endforeach