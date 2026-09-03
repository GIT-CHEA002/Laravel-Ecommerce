<div>
  <button type="button" @click="toggleDarkTheme()">
    <x-heroicon-o-moon class="w-5 h-5" x-show="!darkMode" />
    <x-heroicon-o-sun class="w-5 h-5" x-show="darkMode" />
  </button>
</div>