@php
  $links = [
    [
      'href' => '/admin/dashboard',
      'icon' => 'squares-2x2',
      'name' => 'Dashboard',
      'active' => request()->is('admin/dashboard'),
    ],
    [
      'href' => '/admin/products',
      'icon' => 'archive-box',
      'name' => 'Products',
      'active' => request()->is('admin/products*'),
    ],
    [
      'href' => '/admin/category',
      'icon' => 'rectangle-group',
      'name' => 'Category',
      'active' => request()->is('admin/category*'),
    ],
    [
      'href' => '/admin/orders',
      'icon' => 'shopping-cart',
      'name' => 'Orders',
      'active' => request()->is('admin/orders*'),
    ],
    [
      'href' => '/admin/customers',
      'icon' => 'users',
      'name' => 'Customer',
      'active' => request()->is('admin/user*'),
    ],
    [
      'href' => '/admin/gallery',
      'icon' => 'photo',
      'name' => 'Gallery',
      'active' => request()->is('admin/gallery*'),
    ],
  ];
@endphp

<aside {{ $attributes->merge(['class' => 'w-64 shrink-0 sticky top-0 h-screen overflow-y-auto border-r border-indigo-700 px-4 md:px-6 py-4 md:py-6']) }}>
  <div class="flex flex-col justify-between h-full">
    <x-aside.admin-aside.aside-brand />
    {{-- links section --}}
    <x-aside.admin-aside.aside-links :links="$links" />
    <x-aside.admin-aside.aside-footer />
  </div>
  {{-- header section : brand --}}
</aside>