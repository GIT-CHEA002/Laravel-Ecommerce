@props(['items' => []])
@if ($items)
  <nav aria-label="Breadcrumb" {{ $attributes->class('text-sm py-2') }}>
    <ol class="flex flex-wrap items-center gap-1.5 text-gray-500 dark:text-gray-400">
      @foreach ($items as $item)
        {{-- get the last item on the current loop thrugh the items --}}
        @php
          $isLast = $loop->last;
        @endphp
        <li class="flex items-center gap-1.5">
          @if (!$isLast && !empty($item['url']))
            <a href="{{ $item['url'] }}" class="hover:text-indigo-600 dark:hover:text-indigo-500 hover:underline transition">
              {{ $item['label'] }}
            </a>
          @else
            <span @if ($isLast) aria-current="page" @endif
              class="{{ $isLast ? 'font-medium text-slate-800 dark:text-white' : '' }}">
              {{ $item['label'] }}
            </span>
          @endif
          {{-- show the icons for each links unless the last item (not shown at all) --}}
          @unless ($isLast)
            <x-heroicon-o-chevron-right class="h-3.5 w-3.5 shrink-0" />
          @endunless
        </li>
      @endforeach
    </ol>
  </nav>
@endif