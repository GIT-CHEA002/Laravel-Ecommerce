@php
  $footerSections = [
    [
      'title' => 'Quick Links',
      'links' => [
        ['label' => 'About Us', 'url' => '/about'],
        ['label' => 'Contact', 'url' => '/contact'],
        ['label' => 'Shipping Policy', 'url' => '/shipping-policy'],
        ['label' => 'Privacy Policy', 'url' => '/privacy-policy'],
        ['label' => 'Terms of Service', 'url' => '/terms'],
      ],
    ],
    [
      'title' => 'Categories',
      'links' => [
        ['label' => 'Electronics', 'url' => '/category/electronics'],
        ['label' => 'Home & Garden', 'url' => '/category/home-garden'],
        ['label' => 'Apparel', 'url' => '/category/apparel'],
        ['label' => 'Accessories', 'url' => '/category/accessories'],
      ],
    ],
    [
      'title' => 'Contact Us',
      'links' => [
        [
          'label' => 'support@indigocommerce.com',
          'url' => 'mailto:support@indigocommerce.com',
          'icon' => 'heroicon-o-envelope',
        ],
        [
          'label' => '1-800-INDIGO-9',
          'url' => 'tel:18004634609',
          'icon' => 'heroicon-o-phone',
        ],
      ],
    ],
  ];
@endphp
<footer class="default-padding h-screen">
  {{-- footer nav --}}
  <nav class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 ">
    <div class="block">
      <a href="/" class=" drop-shadow-md inline-flex items-center gap-2 text-sm font-extrabold
                   capitalize tracking-widest text-indigo-700
                   dark:text-indigo-500 md:text-base lg:text-lg">
        <x-heroicon-o-shopping-bag class="h-6 w-6" />
        StoreFront
      </a>
      <x-shared.intro-text>Elevate Your Lifestyle with Premium Essentials Discover our curated collection of
        high-quality products designed to blend seamlessly into your modern life.</x-shared.intro-text>
    </div>
    <x-footer.client-footer.footer-links :footerSections="$footerSections" />
  </nav>
</footer>