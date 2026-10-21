@extends('layout.admin-layout')
@section('title', 'Admin - Edit Product')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
    <x-shared.section-header class=" underline underline-offset-2">Product Edit Form</x-shared.section-header>
    {{-- form --}}
    <x-form.form id="update-product" class="py-3 space-y-4" action="{{ route('admin.products.update', $product) }}"
        method="POST">
        @csrf
        @method('PATCH')
        <div class="flex justify-between items-center  gap-6">
            <x-form.field name="name" label="Name" placeholder="Coca Cola" class="flex-1 py-2" :value="$product->name" />
            <x-form.field name="price" label="Price" placeholder="$20,00..." class="flex-1 py-2" :value="$product->price" />
        </div>
        <x-form.field name="description" label="Description(10-200 words)" placeholder="This product is about..."
            :isTextArea="true" :value="$product->description" />
        <div class="flex justify-between items-center  gap-6">
            <x-form.field name="stock_quantity" label="Stock" placeholder="20..." class="flex-1"
                :value="$product->stock_quantity" />
            <div class="">
                <label for="" class="opacity-0">Category</label>
                <x-form.select name="categories_id" :options="$categories->pluck('name', 'categories_id')"
                    label="Category(optional):" selected="{{ $product->category?->name }}" />
            </div>
        </div>
    </x-form.form>
    <div class="flex justify-end  items-center gap-3 mt-2">
        <div class="w-1/4  flex justify-end items-center gap-4">
            <x-button.primary-button href="{{ url()->previous() }}">Back</x-button.primary-button>
            @if ($product->is_on_market == false)
                @can('restore', $product)
                    <div x-data="{isRestoreOpen : false}">
                        <x-form.button type="button" @click="isRestoreOpen = true" class="rounded-md capitalize "
                            defaultColor="bg-green-600 hover:bg-green-700">
                            Restore
                        </x-form.button>
                        <x-shared.confirm-dialog show="isRestoreOpen" title="Restore Product"
                            message="Are you sure want to restore this product" method="PATCH" confirmText="Restore"
                            confirmStyle="bg-green-700 dark:bg-green-500"
                            action="{{ route('admin.products.restore', $product) }}" />
                    </div>
                @endcan
            @endif
            @if ($product->is_on_market == true)
                @can('delete', $product)
                    <div x-data="{isDeleteOpen : false}">
                        <x-form.button type="button" @click="isDeleteOpen = true" class="rounded-md capitalize "
                            defaultColor="bg-red-600 hover:bg-red-700">
                            Deactivate
                        </x-form.button>
                        <x-shared.confirm-dialog show="isDeleteOpen" title="Deactivate Product"
                            message="Are you sure want to deactivate this product" method="DELETE" confirmText="Deactivate"
                            confirmStyle="bg-red-700 dark:bg-red-500" action="{{ route('admin.products.destroy', $product) }}" />
                    </div>
                @endcan
            @endif
        </div>
        <div class=" flex justify-between items-center gap-4">
            @can('forceDelete', $product)
                <div x-data="{isForceDeleteOpen : false}">
                    <x-form.button type="button" @click="isForceDeleteOpen = true" class="rounded-md capitalize "
                        defaultColor="bg-red-600 hover:bg-red-700">
                        Delete
                    </x-form.button>
                    <x-shared.confirm-dialog show="isForceDeleteOpen" title="Deactivate Product"
                        message="Are you sure want to permanantly delete this product. This Action can not be undo!"
                        method="DELETE" confirmText="Delete" confirmStyle="bg-red-700 dark:bg-red-500"
                        action="{{ route('admin.products.forceDelete', $product) }}" />
                </div>
            @endcan
            <x-form.button form="update-product" class="rounded-md capitalize">Update Product</x-form.button>
        </div>
    </div>
@endsection