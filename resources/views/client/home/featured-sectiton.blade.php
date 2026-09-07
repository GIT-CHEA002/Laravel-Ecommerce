@php
  $features = [
    [
      'icon' => 'check-badge',
      'title' => 'Quality Products',
      'description' => 'We source only the finest materials, ensuring every product meets our rigorous enterprise standards for durability and design.',
    ],
    [
      'icon' => 'lock-closed',
      'title' => 'Secure Shopping',
      'description' => 'Your transactions are protected by industry-leading encryption. We guarantee a safe, seamless, and confident checkout experience.',
    ],
    [
      'icon' => 'truck',
      'title' => 'Fast Delivery',
      'description' => 'Our optimized logistics network ensures your premium goods arrive swiftly and safely, right to your doorstep.',
    ],
  ];
@endphp
<div class="default-padding bg-white dark:bg-slate-900 py-12 ">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10 auto-rows-auto">
    @foreach ($features as $feature)
      <div class=" flex flex-col items-center justify-start gap-3">
        <x-shared.badge-icon :icon="$feature['icon']" />
        <x-shared.section-header class="font-extrabold">{{ $feature['title'] }}</x-shared.section-header>
        <x-shared.intro-text class="text-center">{{ $feature['description'] }}</x-shared.intro-text>
      </div>
    @endforeach
  </div>
</div>