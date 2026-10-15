@php
  $toasts = [];
  if (session('success'))
    $toasts[] = ['type' => 'success', 'message' => session('success')];
  if (session('error'))
    $toasts[] = ['type' => 'error', 'message' => session('error')];
  if ($errors->any())
    $toasts[] = ['type' => 'error', 'message' => 'Please fix the errors in the form.'];
@endphp
@if (count($toasts))
  <div class="fixed top-4 right-4 z-[100] space-y-2">
    @foreach ($toasts as $toast)
      <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-cloak
        x-transition.opacity.duration.300ms role="alert" @class([
          'flex items-center gap-3 px-4 py-3 rounded shadow-lg text-sm text-white min-w-64',
          'bg-green-500 dark:bg-green-700' => $toast['type'] === 'success',
          'bg-red-500 dark:bg-red-700' => $toast['type'] === 'error',
        ])>
        @if ($toast['type'] === 'success')
          <x-heroicon-o-check-circle class="size-5 shrink-0" />
        @else
          <x-heroicon-o-exclamation-circle class="size-5 shrink-0" />
        @endif
        <p class="grow">{{ $toast['message'] }}</p>

        <button type="button" @click="show = false" class="shrink-0 opacity-80 hover:opacity-100">
          <x-heroicon-o-x-mark class="size-4" />
        </button>
      </div>
    @endforeach
  </div>
@endif