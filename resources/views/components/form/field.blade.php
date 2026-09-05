@props([
  'name',
  'label' => false,
  'placeholder',
  'type' => 'text'
])

<div class="space-y-1" @if ($type === 'password') x-data="{ isPasswordShow: false }" @endif>
  @if ($label)
    <x-form.label :$label :$name />
  @endif
  <div class="flex items-center justify-between w-full
                px-4 py-2 text-sm
                bg-white dark:bg-slate-800
                border border-slate-300 dark:border-slate-700
                rounded
                focus-within:border-indigo-700
                dark:focus-within:border-indigo-700
                transition-colors duration-300">

    <x-form.input :name="$name" :label="$label" :placeholder="$placeholder" :type="$type"
      x-bind:type="isPasswordShow ? 'text' : 'password'" />

    @if ($type === 'password')
      <button type="button" class="w-fit shrink-0" @click="isPasswordShow = !isPasswordShow">
        <x-heroicon-o-eye class="w-4 h-4" x-show="!isPasswordShow" />
        <x-heroicon-o-eye-slash class="w-4 h-4" x-show="isPasswordShow" />
      </button>
    @endif

  </div>

  <x-form.error :error="$errors->first($name)" />

</div>
