import './bootstrap';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

window.Alpine = Alpine;

Alpine.plugin(persist); // register BEFORE Alpine.start()

Alpine.data('theme', () => ({
  darkMode: JSON.parse(localStorage.getItem('darkMode')) ?? false,
  toggleDarkTheme() {
    this.darkMode = !this.darkMode;
    localStorage.setItem('darkMode', JSON.stringify(this.darkMode));
  }
}));

Alpine.start();



