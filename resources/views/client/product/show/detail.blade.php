@php
  $images = $product->productImages->map(
    fn($image) => [
      'image_id' => $image->image_id,
      'image_url' => $image->image_url,
    ]
  );
  $selectedImage = $images->first()['image_id'] ?? null;
@endphp
<div x-data="{
    images: {{ $images->toJson() }},
    selectedImage: {{ $selectedImage ?? 'null' }}
  }" class="py-2">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 auto-rows-auto">
    @include('client.product.show.detail-image', ['images' => $images])
    @include('client.product.show.detail-text', ['product' => $product])
  </div>
</div>