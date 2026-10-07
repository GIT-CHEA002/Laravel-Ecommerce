<div {{ $attributes->merge(['class' => 'px-6 md:px-8 py-4 md:py-6  flex-1 min-w-0 h-fit border-b border-indigo-700']) }}>
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

          {{-- full-screen overlay --}}
          <div x-show="isLogoutDialog" x-cloak @keydown.escape.window="isLogoutDialog = false"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4">

            {{-- backdrop --}}
            <div x-show="isLogoutDialog" x-transition.opacity @click="isLogoutDialog = false"
              class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

            {{-- panel --}}
            <div x-show="isLogoutDialog" x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95" role="dialog" aria-modal="true"
              class="relative w-full max-w-sm rounded-xl border border-indigo-200 bg-indigo-50
                                                                                                                                                          p-6 shadow-xl dark:border-slate-700 dark:bg-slate-900">

              <h2 class="text-lg font-bold text-indigo-700 dark:text-indigo-500">Log out?</h2>
              <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                You'll need to sign in again to access your account.
              </p>

              <div class="mt-6 flex justify-end gap-3">
                <button type="button" @click="isLogoutDialog = false"
                  class="cursor-pointer rounded-md px-3 py-1.5 text-sm font-semibold text-slate-700
                                                                                                                                                           transition hover:bg-indigo-100 dark:text-slate-300 dark:hover:bg-slate-800">
                  Cancel
                </button>

                <x-form.form method="POST" action="{{ route('logout-user') }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="cursor-pointer rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold
                                                                                                                                                             text-white transition hover:bg-red-700">
                    Yes, log out
                  </button>
                </x-form.form>
              </div>
            </div>
          </div>
        @endif
      @endauth
    </div>
  </div>
</div>