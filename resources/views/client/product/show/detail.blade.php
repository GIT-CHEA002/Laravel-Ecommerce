@php
  $images = $product->productImages->map(
    fn($image) => [
      'image_id' => $image->image_id,
      'image_url' => "https://picsum.photos/seed/{$product->product_id}-{$image->image_id}/600/600",
    ]
  );
  $selectedImage = $images->first()['image_id'] ?? null;
@endphp
<div x-data="{
    images: {{ $images->toJson() }},
    selectedImage: {{ $selectedImage ?? 'null' }}
  }" class="py-2">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 auto-rows-auto">
    @include('client.products.show.detail-image', ['images' => $images])
    @include('client.products.show.detail-text', ['images' => $images])
  </div>
</div>
