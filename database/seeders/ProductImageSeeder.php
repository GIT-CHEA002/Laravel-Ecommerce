<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // attach to the exist product with 3 or more product image Url 
        Product::all()->each(function (Product $product) {
            ProductImage::factory(fake()->numberBetween(3, 4))->create(
                [
                    'product_id' => $product->product_id
                ]
            );
        });
    }
}
