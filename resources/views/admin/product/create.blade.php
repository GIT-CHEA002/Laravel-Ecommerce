@extends('layout.admin-layout')
@section('title', 'Admin - Create Product')
@section('favicon', asset('images/favicons/register.png'))
@section('content')
    <div>
        <x-shared.section-header class=" underline underline-offset-2">Product Adding Form</x-shared.section-header>
        {{-- form --}}
        <x-form.form class="py-3 space-y-4" action="{{ route('admin.products.store') }}" method="POST">
            <div class="flex justify-between items-center  gap-6">
                <x-form.field name="name" label="Name" placeholder="Coca Cola" class="flex-1 py-2" />
                <x-form.field name="price" label="Price" placeholder="$20,00..." class="flex-1 py-2" />
            </div>
            <x-form.field name="description" label="Description(10-200 words)" placeholder="This product is about..."
                :isTextArea="true" />
            <div class="flex justify-between items-center  gap-6">
                <x-form.field name="stock_quantity" label="Stock" placeholder="20..." class="flex-1" />
                <div class="">
                    <label for="" class="opacity-0">Category</label>
                    <x-form.select name="categories_id" :options="$categories->pluck('name', 'categories_id')"
                        label="Category(optional):" selected="{{ $categories->first()->name }}" />
                </div>
                <div class="">
                    <label for="" class="opacity-0">Category</label>
                    <x-form.checkbox name="is_on_market" label="Avaible(On Market ?)" />
                </div>
            </div>
            <div class="flex justify-end  items-center gap-3 mt-2">
                <div class="w-1/4  flex justify-end items-center">
                    <x-button.primary-button href="{{ route('admin.products.index') }}"
                        class="bg-red-700 dark:bg-red-500">Cancel</x-button.primary-button>
                </div>
                <div class="w-1/4 ">
                    <x-form.button class="rounded-md capitalize">Add New Product</x-form.button>
                </div>
            </div>
        </x-form.form>
    </div>
@endsection