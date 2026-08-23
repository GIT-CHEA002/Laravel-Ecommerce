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
            OrderProduct::factory(fake()->numberBetween(1, 4))->create([
                'order_id' => $order->order_id,
                'product_id' => Product::inRandomOrder()->value('product_id')
            ]);
        });
    }
}
