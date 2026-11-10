<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Order::all()->each(function (Order $order) {
            $products = Product::inRandomOrder()
                ->limit(fake()->numberBetween(1, 4))
                ->get();
            foreach ($products as $product) {
                OrderProduct::factory()->create([
                    'order_id'     => $order->order_id,
                    'product_id'   => $product->product_id,
                    'product_name' => $product->name,
                    'product_sku'  => $product->stock_quantity,
                    'unit_price'   => $product->price,
                ]);
            }
        });
    }
}
