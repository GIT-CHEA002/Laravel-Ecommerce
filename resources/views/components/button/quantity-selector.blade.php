@props(['initial' => 1, 'min' => 1, 'max' => 10, 'name' => 'quantity'])
<div x-data="quantitySelector({{ $initial }},{{ $min }},{{ $max }})" {{ $attributes->merge(['class' => 'flex justify-between items-center gap-4 bg-white/90 dark:bg-slate-800 py-1 px-3 rounded-md']) }}>
  <button @click="decrement()" class="">
    <x-heroicon-s-minus class="w-4 h-4" />
  </button>
  <input type="text" hidden name="{{ $name }}" id="{{ $name }}" :value="product">
  <span x-text="productQuantity" class="font-semibold"></span>
  <button @click="increment()">
    <x-heroicon-s-plus class="w-4 h-4" />
  </button>
</div>
@once
  @push('scripts')
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.data('quantitySelector', (initial = 1, min = 1, max = 10) => ({
          productQuantity: initial,
          min: min,
          max: max,
          increment() {
            if (this.productQuantity < this.max) {
              this.productQuantity++;
            }
          },
          decrement() {
            if (this.productQuantity > this.min) {
              this.productQuantity--;
            }
          }
        }));
      });
    </script>
  @endpush
@endonce