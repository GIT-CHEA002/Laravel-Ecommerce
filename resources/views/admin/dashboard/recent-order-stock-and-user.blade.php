{{-- Stock and user alerts --}}
<div class="flex flex-col justify-between col-span-1 gap-5 rounded-lg">
  {{-- low stock alerts --}}
  <div class="flex-1 px-4 py-6 bg-white border rounded-md shadow-md dark:bg-slate-800">
    {{-- alert title --}}
    <div class="flex justify-between">
      <h1 class="font-semibold tracking-wide capitalize">low stock alerts</h1>
      <x-heroicon-s-exclamation-triangle class="w-5 h-5 text-red-500 animate-pulse" />
    </div>
    {{-- low stock product list --}}
    <div class="block pt-3 space-y-4">
      {{-- card row --}}
      @foreach ([1, 2, 4, 5] as $num)
        <div class="flex items-center justify-between">
          {{-- image --}}
          <div class="w-10 h-10 overflow-hidden border rounded-md shadow-sm">
            <img src="https://picsum.photos/400/300" alt="#image of the product" class="object-cover w-full h-full">
          </div>
          {{-- text --}}
          <div class="flex flex-col justify-between flex-1 leading-none ps-2">
            <h1 class="text-sm line-clamp-1">Ice coffee</h1>
            <h2 class="text-sm">$24.00</h2>
          </div>
          {{-- status --}}
          <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-500">2 left</x-shared.badge-tag>
        </div>
      @endforeach
    </div>
  </div>
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
      @foreach ([1, 2, 4, 5] as $num)
        <div class="flex items-center justify-between">
          {{-- image --}}
          <div class="w-10 h-10 overflow-hidden border rounded-md shadow-sm">
            <img src="https://picsum.photos/500/300" alt="#image of the product" class="object-cover w-full h-full">
          </div>
          {{-- text --}}
          <div class="flex flex-col justify-between flex-1 leading-none ps-2">
            <h1 class="text-sm font-semibold tracking-wide line-clamp-1">Chhun Sokchea</h1>
            <h2 class="text-xs tracking-wide">sokcheachhun@gmail.com</h2>
          </div>
          {{-- status --}}
          {{-- time register --}}
          <span></span>
        </div>
      @endforeach
    </div>
  </div>
</div>