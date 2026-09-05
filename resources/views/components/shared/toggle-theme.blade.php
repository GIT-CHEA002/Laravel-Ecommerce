<div>
  <button type="button" @click="toggleDarkTheme()">
    <x-heroicon-o-moon class="w-5 h-5 m-auto text-indigo-700 dark:text-indigo-600" x-show="!darkMode" />

    <x-heroicon-o-sun class="w-5 h-5 m-auto text-indigo-700 dark:text-indigo-600" x-show="darkMode" />
  </button>
</div>