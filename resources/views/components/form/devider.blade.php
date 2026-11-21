@props([
  'displayText' => null
])
<div class="my-10">
  @if ($displayText !== null)
    <div class="flex items-center gap-4">
      <div class="h-px flex-1 bg-black/50 dark:bg-white"></div>
      @if ($displayText != null)
        <span class="text-sm  whitespace-nowrap">
          {{ $displayText}}
        </span>
      @endif
      <div class="h-px flex-1 bg-black/50 dark:bg-white"></div>
    </div>
  @else
    <div class="h-px w-full bg-black/50 dark:bg-white"></div>
  @endif
</div>