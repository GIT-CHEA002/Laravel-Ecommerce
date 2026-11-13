{{-- new sign ups --}}
<div class="flex-1 px-4 py-6 bg-white border rounded-md shadow-md dark:bg-slate-800">
  {{-- alert title --}}
  <div class="flex justify-between">
    <h1 class="font-semibold tracking-wide capitalize">new sign up</h1>
    <a href="#"
      class="text-sm font-bold tracking-wide text-indigo-700 capitalize transition-all duration-300 dark:text-indigo-500 hover:scale-105">
      see all
    </a>
  </div>
  {{-- new user list --}}
  <div class="block pt-3 space-y-4">
    {{-- card row --}}
    @foreach ($newRegister as $user)
      <div class="flex items-center justify-between">
        {{-- image --}}
        <div class="w-10 h-10 overflow-hidden border rounded-md shadow-sm">
          <img src="{{ $user->avatar ?: 'https://placehold.co/200x300?text=No+Image' }}" alt="{{ $user->first_name }}"
            class="object-cover w-full h-full">
        </div>
        {{-- text --}}
        <div class="flex flex-col justify-between flex-1 leading-none ps-2">
          <h1 class="text-sm font-semibold tracking-wide line-clamp-1">{{ $user->first_name }}-{{ $user->last_name }}
          </h1>
          <h2 class="text-xs tracking-wide">{{ $user->email }}</h2>
        </div>
      </div>
    @endforeach
  </div>
</div>