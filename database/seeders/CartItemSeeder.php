<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Database\Factories\CartItemFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call(CartItemFactory::class);
        Cart::all()->each(function (Cart $cart) {
            $itemCount = fake()->numberBetween(1, 4);

            // grab N unique random products so this cart never repeats a product
            $productIds = Product::inRandomOrder()->limit($itemCount)->pluck('product_id');

            foreach ($productIds as $productId) {
                CartItem::factory()->create([
                    'cart_id' => $cart->cart_id,
                    'product_id' => $productId,
                ]);
            }
        });
    }
}
