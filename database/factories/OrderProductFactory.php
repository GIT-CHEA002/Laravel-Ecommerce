<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'order_id'     => 1,
            'product_id'   => 1,
            'product_name' => null,      // snapshot
            'product_sku'  => 0,         // snapshot
            'unit_price'   => 0,         // snapshot
            'quantity'     => fake()->numberBetween(1, 5),
        ];
    }
}
