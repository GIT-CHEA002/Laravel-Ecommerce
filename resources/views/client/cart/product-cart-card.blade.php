<div class="flex flex-col md:flex-row justify-between md:items-center border-b-2 pb-3">
  {{-- Image and title --}}
  <div class="flex-1 p-2 flex items-start gap-2">
    <div class="w-[80px] h-[80px] rounded-md overflow-hidden shadow-sm">
      <img src="https://picsum.photos/200/300" alt="Cart Image" class="h-full w-full object-cover">
    </div>
    <div class="pt-2">
      <h1 class="capitalize font-semibold text-lg tracking-wide">Product Title</h1>
      <p class="text-xs tracking-wide bg-indigo-100 px-2 rounded-md text-black w-fit">Premium Electronics</p>
    </div>
  </div>
  {{-- Price, quantity, and remove button --}}
  <div class="flex-1 flex justify-between items-center p-2">
    <span class="text-slate-500 line-through text-sm">$299.00</span>
    <x-button.quantity-selector name="productQuantity" />
    <span class="font-semibold">$288.40</span>
    <button class="text-red-500 dark:text-red-600 hover:text-red-700 transition">
      <x-heroicon-o-trash class="h-4 w-4" />
    </button>
  </div>
</div>