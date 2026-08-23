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
            CartItem::factory(fake()->numberBetween(1, 4))->create([
                'cart_id' => $cart->cart_id,
                'product_id' => Product::inRandomOrder()->value('product_id')
            ]);
        });
    }
}
