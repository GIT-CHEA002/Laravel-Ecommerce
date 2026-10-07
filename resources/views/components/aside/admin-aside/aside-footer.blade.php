<div {{ $attributes->merge(['class' => 'border-t-2 border-indigo-700 dark:border-indigo-500 py-3 space-y-2']) }}>
  <a href=""
    class="flex items-center text-sm tracking-wide gap-2 font-medium px-2 md:px-4 lg:px-6 py-1.5 rounded-md text-black dark:text-white hover:bg-indigo-700 dark:hover:bg-indigo-500 hover:text-white/90 hover:scale-[1.01] hover:shadow-sm transition duration-300">
    <x-heroicon-o-user-circle class="w-5 h-5" />
    <span>Profile</span>
  </a>
  <a href=""
    class="flex items-center text-sm tracking-wide gap-2 font-medium px-2 md:px-4 lg:px-6 py-1.5 rounded-md text-red-700 dark:text-red-500 hover:bg-red-700 dark:hover:bg-red-500 hover:text-white/90 dark:hover:text-white/90 hover:scale-[1.01] hover:shadow-sm transition duration-300">
    <x-heroicon-o-arrow-right-start-on-rectangle class="w-5 h-5" />
    <span>Logout</span>
  </a>
</div>