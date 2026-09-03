import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.data('theme', () => ({
  // state 
  darkMode: JSON.parse(localStorage.getItem('darkMode')) ?? false,
  // method : toggle the theme class 
  toggleDarkTheme() {
    this.darkMode = !this.darkMode;
    localStorage.setItem('darkMode',JSON.stringify(this.darkMode));
  }
}));

Alpine.start();



