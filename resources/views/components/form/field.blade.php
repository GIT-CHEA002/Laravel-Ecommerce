@props([
  'name',
  'label' => false,
  'placeholder' => '',
  'type' => 'text',
  'icon' => null,
  'isTextArea' => false,
])

@php
  $isPassword = $type === 'password';
@endphp

<div {{ $attributes->only('class')->class(['space-y-1']) }} @if ($isPassword) x-data="{ show: false }" @endif>
  @if ($label)
    <x-form.label :$label :$name />
  @endif

  <div @class([
    'flex gap-2 w-full px-4 py-2 text-sm',
    'bg-white dark:bg-slate-800',
    'items-center' => !$isTextArea,
    'items-start' => $isTextArea,
    'border border-slate-300 dark:border-slate-700 rounded',
    'focus-within:border-indigo-700 transition-colors duration-300',
  ])>
    @if ($icon)
      <x-dynamic-component :component="'heroicon-o-' . $icon" class="size-4 shrink-0 text-slate-400" />
    @endif

    @if ($isPassword)
      <x-form.input :$name :$placeholder type="password" x-bind:type="show ? 'text' : 'password'" />
      <button type="button"
        class="shrink-0 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors"
        @click="show = !show">
        <x-heroicon-o-eye class="size-4" x-show="!show" />
        <x-heroicon-o-eye-slash class="size-4" x-show="show" x-cloak />
      </button>
    @elseif ($isTextArea)
      <x-form.text-area :$name :$placeholder />
    @else
      <x-form.input :$name :$placeholder :$type />
    @endif
  </div>

  <x-form.error :error="$errors->first($name)" />
</div>