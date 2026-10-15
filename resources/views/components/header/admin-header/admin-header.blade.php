<div {{ $attributes->merge(['class' => 'px-6 md:px-8 py-4 md:py-6  flex-1 min-w-0 h-fit border-b border-indigo-700  shadow-sm dark:bg-slate-950']) }}>
  <div class="flex justify-between items-center">
    {{-- search section --}}
    <x-form.form class="md:flex my-auto hidden">
      <x-header.client-header.search-form-field />
    </x-form.form>
    <div class="w-fit flex justify-between items-center gap-3" x-data="{isLogoutDialog:false}">
      <x-shared.toggle-theme />
      {{-- log out dialog --}}
      @auth
        @if (auth()->user()->isAdmin())
          <button type="button" @click="isLogoutDialog = true"
            class="relative flex w-fit cursor-pointer items-center justify-center gap-1 rounded-md border border-indigo-200 bg-indigo-50 px-2 py-1 text-indigo-700 transition hover:bg-indigo-100 dark:border-slate-700 dark:bg-slate-800 dark:text-indigo-500">
            <span class="text-xs tracking-wide">Log out</span>
            <x-heroicon-o-user class="h-5 w-5 text-indigo-700 dark:text-indigo-500" />
          </button>
          <x-shared.confirm-dialog show="isLogoutDialog" title="Confirm Logout"
            message="You need to be sign in again after log out ? " action="{{ route('logout-user') }}"
            confirmText="Log Out" />
        @endif
      @endauth
    </div>
  </div>
</div>