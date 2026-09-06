<x-form.form>
  <a {{ $attributes->merge([
  'class' => 'text-red-500 dark:text-red-700 bg-red-50/70 rounded-md py-1 px-3',
]) }}>
    <span class="text-sm">{{ $slot }}</span>
  </a>
  <x-form.button>Log out</x-form.button>
</x-form.form>