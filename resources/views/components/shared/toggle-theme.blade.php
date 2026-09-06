<button type="button" @click="toggleDarkTheme()" {{ $attributes->merge([
  'class' => 'relative flex  w-fit cursor-pointer items-center
            justify-center gap-1 rounded-md border border-indigo-200
            bg-indigo-50 px-2 py-1 text-indigo-700
            transition hover:bg-indigo-100
            dark:border-slate-700 dark:bg-slate-800
            dark:text-indigo-500'
]) }}>
  <span class="block md:hidden" x-show="darkMode">Light</span>
  <span class="block md:hidden" x-show="!darkMode">Dark</span>
  <x-heroicon-o-moon class="w-5 h-5  text-indigo-700 dark:text-indigo-600" x-show="!darkMode" />
  <x-heroicon-o-sun class="w-5 h-5  text-indigo-700 dark:text-indigo-600" x-show="darkMode" />
</button>