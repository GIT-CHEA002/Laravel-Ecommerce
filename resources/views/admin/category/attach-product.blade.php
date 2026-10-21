@php
  $breadcrumpLink = [
    ['label' => 'Category', 'url' => route('admin.category.index')],
    ['label' => $category->name . ' (' . $category->categories_id . ')', 'url' => route('admin.category.show', $category)],
    ['label' => 'Attach'],
  ];
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - category Management')
@section('page-heading', 'Product Management')\
@section('content')
  {{-- Header --}}
  <x-shared.breadcrumb class="pb-3" :items="$breadcrumpLink" />
  <div class="block pb-4">
    <x-shared.section-header>Category - Attach Product</x-shared.section-header>
    <x-shared.intro-text>Manage Your Category Product by attaching them</x-shared.intro-text>
  </div>
  <div class="grid grid-cols-3 gap-6" x-data="{
                                                                key: 'attach-{{ $category->id }}',
                                                                selected: [], {{-- state to store the attached products --}}

                                                                init() {
                                                                  try {
                                                                    this.selected = JSON.parse(sessionStorage.getItem(this.key) || '[]')
                                                                  } catch (e) {
                                                                    this.selected = []
                                                                  }

                                                                  if (!Array.isArray(this.selected)) this.selected = []

                                                                  this.$watch('selected', v => sessionStorage.setItem(this.key, JSON.stringify(v)))
                                                                }
                                                              }">

    {{-- ============ Products table ============ --}}
    <div class="col-span-2">
      @if ($products->isNotEmpty())
        <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit overflow-hidden">
          <table class="w-full text-sm text-left dark:text-white">

            <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
              <tr class="font-light">
                @foreach (['Image', 'Product Name', 'Price', 'Stock', 'Status', 'Action'] as $heading)
                  <th class="px-3 py-3">{{ $heading }}</th>
                @endforeach
              </tr>
            </thead>

            <tbody class="divide-y">
              @foreach ($products as $product)
                <tr x-show="!selected.some(p => p.id === {{ $product->getKey() }})">

                  {{-- Image --}}
                  <td class="px-3 py-2">
                    <div class="w-10 h-10 rounded-md overflow-hidden">
                      <img
                        src="{{ $product->productImages->first()?->image_url ?? 'https://placehold.co/200x300?text=No+Image' }}"
                        alt="{{ $product->name }}" class="object-cover w-full h-full">
                    </div>
                  </td>

                  {{-- Name --}}
                  <td class="px-3 py-2">{{ $product->name }}</td>

                  {{-- Price --}}
                  <td class="px-3 py-2">${{ number_format($product->price, 2) }}</td>

                  {{-- Stock quantity --}}
                  <td class="px-3 py-2">{{ $product->stock_quantity }}</td>

                  {{-- Status --}}
                  <td class="px-3 py-2">
                    @if ($product->is_on_market)
                      @if ($product->stock_quantity == 0)
                        <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">
                          Out of Stock
                        </x-shared.badge-tag>
                      @elseif ($product->stock_quantity <= 10)
                        <x-shared.badge-tag bgColor="bg-amber-100" textColor="text-amber-600">
                          Low Stock
                        </x-shared.badge-tag>
                      @else
                        <x-shared.badge-tag>In Stock</x-shared.badge-tag>
                      @endif
                    @else
                      <x-shared.badge-tag bgColor="bg-red-100" textColor="text-red-600">
                        Not Available
                      </x-shared.badge-tag>
                    @endif
                  </td>

                  {{-- Action --}}
                  <td class="px-3 py-2">
                    <button type="button"
                      class="inline-flex items-center justify-center gap-2 px-4 lg:px-6 py-1.5 text-sm text-white bg-indigo-700 dark:bg-indigo-500 rounded-md shadow-sm hover:scale-[1.01] hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition-transform duration-300"
                      @click="selected.push({ id: {{ $product->getKey() }}, name: @js($product->name) })">
                      Attach
                    </button>
                  </td>

                </tr>
              @endforeach
            </tbody>

          </table>
        </div>
        {{-- Pagination --}}
        <div class="py-3">
          {{ $products->links() }}
        </div>
      @else
        <div class="border rounded-md shadow-md dark:bg-slate-800 my-3 px-3 py-6 text-center text-gray-500">
          All products are already attached to this category.
        </div>
      @endif
    </div>

    {{-- ============ Selected products panel ============ --}}
    <div>
      <div class="bg-white dark:bg-slate-800 rounded-md shadow-md h-fit">

        <x-form.form method="POST" action="{{ route('admin.category.product.attach', $category) }}"
          @submit="sessionStorage.removeItem(key)" class="rounded-md p-4 h-fit">
          @csrf
          @method('PATCH')

          <h3 class="font-semibold mb-3 dark:text-white">
            Selected (<span x-text="selected.length"></span>)
          </h3>

          <p x-show="selected.length === 0" class="text-sm text-gray-600 dark:text-gray-300">
            No products selected yet.
          </p>
          {{-- Render the selected products --}}
          <template x-for="p in selected" :key="p.id">
            <div class="flex items-center gap-3 px-3 py-2 mb-2 rounded-md bg-white/70 dark:bg-slate-800 shadow-sm">
              <input type="hidden" name="product_ids[]" :value="p.id">
              <span
                class="shrink-0 px-2 py-0.5 text-xs font-medium rounded bg-indigo-100 text-indigo-700 dark:bg-slate-600 dark:text-indigo-200"
                x-text="'#' + p.id"></span>
              <span class="flex-1 min-w-0 truncate text-sm font-medium text-slate-800 dark:text-white" x-text="p.name"
                :title="p.name"></span>
              <button type="button"
                class="shrink-0 p-1 rounded-full text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-slate-700 transition"
                @click="selected = selected.filter(x => x.id !== p.id)" aria-label="Remove">
                <x-heroicon-o-x-mark class="h-4 w-4" />
              </button>
            </div>
          </template>
          <div class="py-2" x-data="{isAttachOpen : false}">
            <x-form.button type="button" @click="isAttachOpen = true" x-bind:disabled="selected.length === 0"
              class="rounded-md mt-3 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
              Save to category "{{ $category->name }}"
            </x-form.button>
            <x-shared.confirm-dialog show="isAttachOpen" title="Attach Category"
              confirmStyle="bg-green-700 dark:bg-green-500"
              message="Are you sure want to attach these product to category category : {{ $category->name }}"
              method="PATCH" action="{{ route('admin.category.product.attach', $category) }}" confirmText="Attach" />
          </div>
        </x-form.form>
      </div>
      {{-- Back button --}}
      <div class="pt-4">
        <x-button.primary-button class="w-full" href="{{ url()->previous() }}">
          Back
        </x-button.primary-button>
      </div>
    </div>
  </div>
@endsection