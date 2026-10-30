@php
    $breadcrumpLink = [
        ['label' => 'Orders', 'url' => route('admin.orders.index')],
        ['label' => 'Show'],
    ];
@endphp
@extends('layout.admin-layout')
@section('title', 'Admin - Order show')
@section('page-heading', 'Total Orders')
@section('content')
    <x-shared.breadcrumb :items="$breadcrumpLink" />
    <div class="flex justify-between items-center">
        <div class="block">
            <x-shared.section-header>Orders : {{ $order->order_number }} </x-shared.section-header>
            <x-shared.intro-text>Place on : {{ $order->created_at->format('l d F Y') }}</x-shared.intro-text>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-6 auto-rows-auto mt-4">
        <div class=" col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-800 shadow-md rounded-md p-4 space-y-3">
                {{-- header --}}
                <div class="flex justify-start items-center pb-1 border-b">
                    <x-heroicon-o-user class="w-5 h-5" />
                    <span class="text-lg  tracking-wide font-medium ps-1">Customer Information</span>
                </div>
                <div class="flex justify-between items-start gap-6  ">
                    <div class="flex-1 space-y-4">
                        <x-shared.display-text label="Name">{{ $order->user->first_name }}
                            {{ $order->user->last_name }}</x-shared.display-text>
                        <x-shared.display-text label="Phone">
                            {{-- {{ $order->user->phone }} --}}
                            071 57 63 396
                        </x-shared.display-text>
                    </div>
                    <div class="flex-1 space-y-4">
                        <x-shared.display-text label="Email">
                            {{ $order->user->email }}
                        </x-shared.display-text>
                        <x-shared.display-text label="Account status">
                            Register on
                            {{ $order->user->created_at->format('d F Y') }}
                        </x-shared.display-text>
                    </div>
                </div>
            </div>
            {{-- ================Shipping address============== --}}
            <div class="bg-white dark:bg-slate-800 shadow-md rounded-md p-4 space-y-3">
                {{-- header --}}
                <div class="flex justify-start items-center pb-1 border-b">
                    <x-heroicon-o-truck class="w-5 h-5" />
                    <span class="text-lg  tracking-wide font-medium ps-1">Shipping Address</span>
                </div>
                <x-shared.display-text label="Address">{{ $order->shipping_address }}</x-shared.display-text>
            </div>
            {{-- order items --}}
            <div class="border rounded-md shadow-md dark:bg-slate-800 h-fit my-3 overflow-hidden">
                <table class="w-full text-sm text-left dark:text-white">
                    <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700">
                        <tr class="font-light">
                            @foreach (['Image', 'Item Name', 'Price', 'Qty', 'Subtotal'] as $heading)
                                <th class="px-3 py-3">{{ $heading }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($order->orderProduct as $item)
                            <tr>
                                <td class="px-3 py-2">
                                    <div class="w-10 h-10 rounded-md overflow-hidden">
                                        <img src="{{ $item->products->productImages->first()?->image_url ?? 'https://picsum.photos/200/300' }}"
                                            alt="{{ $item->products->name }}" class="object-cover w-full h-full">
                                    </div>
                                </td>
                                <td class="px-3 py-2">{{ $item->products->name }}</td>
                                <td class="px-3 py-2">${{ number_format($item->products->price, 2) }}</td>
                                <td class="px-3 py-2">{{ $item->quantity }}</td>
                                <td class="px-3 py-2">${{ number_format($item->quantity * $item->products->price, 2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- summary --}}
        @php
            $subtotal = $order->orderProduct->sum(fn($item) => $item->products->price * $item->quantity);
            $shipping = 12.00;
            $tax = 5.32;
        @endphp
        <div class=" col-span-1 space-y-6">
            <div class="bg-white dark:bg-slate-800 shadow-md rounded-md p-4 pb-5 space-y-3">
                {{-- header --}}
                <div class="flex justify-start items-center pb-1 border-b">
                    <x-heroicon-o-shopping-cart class="w-5 h-5" />
                    <span class="text-lg  tracking-wide font-medium ps-1">Order Summary</span>
                </div>
                {{-- content --}}
                <div class="flex justify-between items-center">
                    <span class="text-sm tracking-wide">Subtotal</span>
                    <span class="text-sm tracking-wide">${{ number_format($subtotal, 2)  }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm tracking-wide">Shipping(Express) </span>
                    <span class="text-sm tracking-wide">${{ number_format(12, 2)  }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-sm tracking-wide">Tax </span>
                    <span class="text-sm tracking-wide">${{ number_format(5.32, 2)  }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold tracking-wide">Total </span>
                    <span
                        class="text-lg font-semibold tracking-wide">${{ number_format($subtotal + $shipping + $tax, 2)  }}</span>
                </div>
                <div class="block border-b pb-2">
                    <h1 class="text-sm font-bold tracking-wide">
                        Payment Method
                    </h1>
                    <h2 class="text-sm flex justify-start items-center gap-1 tracking-wide">
                        <x-heroicon-o-banknotes class="w-5 h-5 text-indigo-700" />
                        <span>Visa Ending in 2***8444</span>
                    </h2>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm tracking-wide">Status </span>
                    <x-shared.badge-tag>{{ $order->status }}</x-shared.badge-tag>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 shadow-md rounded-md p-4 pb-5 space-y-3">
                {{-- header --}}
                <div class="flex justify-start items-center pb-1 border-b">
                    <x-heroicon-o-shopping-cart class="w-5 h-5" />
                    <span class="text-lg  tracking-wide font-medium ps-1">Internal Notes</span>
                </div>
                <div class="">
                    <x-shared.display-text>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium error enim impedit nam
                        voluptates odit, voluptate tempore nostrum saepe explicabo!
                    </x-shared.display-text>
                </div>
            </div>
            {{-- action button --}}
            <div class="bg-white dark:bg-slate-800 shadow-md rounded-md p-4 pb-5 space-y-3">
                {{-- header --}}
                <div class="flex justify-start items-center pb-1 border-b">
                    <x-heroicon-o-shopping-cart class="w-5 h-5" />
                    <span class="text-lg  tracking-wide font-medium ps-1">Actions</span>
                </div>
                <div class="space-y-3">
                    <x-button.primary-button href="{{ url()->previous() }}" class="w-full">back</x-button.primary-button>
                    <x-button.primary-button href="#" class="w-full">delete</x-button.primary-button>
                </div>
            </div>
        </div>
    </div>
@endsection