<div {{ $attributes->merge([
  'class' => 'flex w-fit items-center justify-center gap-1
            rounded-full border border-slate-400
            bg-indigo-50/90 px-4 py-1
            dark:border-slate-700 dark:bg-slate-800'
]) }}>
  <x-heroicon-o-magnifying-glass class="h-4 w-4 text-slate-600 dark:text-slate-300" />
  <input type="text" name="search" placeholder="search..." class="h-full bg-transparent text-sm tracking-wide
               text-slate-700 outline-none
               placeholder:text-slate-500
               dark:text-slate-200
               dark:placeholder:text-slate-400
              placeholder:text-sm placeholder:tracking-wide">
</div>