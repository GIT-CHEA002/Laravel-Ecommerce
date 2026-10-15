@props([
  'show',
  'title',
  'message',
  'action',
  'confirmText' => 'Confirm',
  'confirmStyle' => 'bg-red-600 hover:bg-red-700',
  'method' => 'DELETE'
])

<div x-show="{{ $show }}" x-cloak @keydown.escape.window="{{ $show }} = false"
  class="fixed inset-0 z-[100] flex items-center justify-center p-4">
  {{-- backdrop --}}
  <div x-show="{{ $show }}" x-transition.opacity @click="{{ $show }} = false"
    class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

  {{-- panel --}}
  <div x-show="{{ $show }}" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95" role="dialog" aria-modal="true"
    class="relative w-full max-w-sm rounded-xl border border-indigo-200 bg-indigo-50 p-6 shadow-xl dark:border-slate-700 dark:bg-slate-900">

    <h2 class="text-lg font-bold text-indigo-700 dark:text-indigo-500">{{ $title }}</h2>
    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
      {{ $message }}
    </p>

    <div class="mt-6 flex justify-end gap-3">
      <button type="button" @click="{{ $show }} = false"
        class="cursor-pointer rounded-md px-3 py-1.5 text-sm font-semibold text-slate-700 transition bg-white dark:bg-slate-800 hover:bg-indigo-100 dark:text-slate-300 dark:hover:bg-slate-800">
        cancel
      </button>

      <x-form.form method="POST" action="{{ $action }}">
        @csrf
        @method($method)
        <button type="submit"
          class="cursor-pointer rounded-md  px-3 py-1.5 text-sm font-semibold text-white transition {{ $confirmStyle }} ">
          {{ $confirmText }}
        </button>
      </x-form.form>
    </div>
  </div>
</div>