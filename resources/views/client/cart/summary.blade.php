<div class="md:col-span-1 rounded-md p-3 pb-7 border h-fit bg-white dark:bg-slate-800">
  <h1 class="text-lg font-semibold capitalize border-b-2 pb-2">Order summary</h1>
  {{-- price summary --}}
  <div class="border-b-2">
    <div class="flex justify-between items-center px-1 py-2">
      <span class="tracking-wide">Subtotal (2 items)</span>
      <span>$799.00</span>
    </div>
    <div class="flex justify-between items-center px-1 py-2">
      <span class="tracking-wide">Shipping</span>
      <span>Free</span>
    </div>
    <div class="flex justify-between items-center px-1 py-2">
      <span class="tracking-wide">Tax</span>
      <span>$450</span>
    </div>
  </div>
  <div class="flex justify-between items-center px-1 py-2">
    <span class="tracking-wide">Total</span>
    <span class="font-bold text-indigo-700 dark:text-indigo-500 text-lg">$450</span>
  </div>
  <x-button.primary-button href="#" class="w-full justify-center">Proceed to checkout</x-button.primary-button>
</div>