<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'order_number' => \Illuminate\Support\Str::random(10),
            'total_amount' => 10000,
            'status' => fake()->randomElement(['shipping', 'pending', 'arrived']),
            'shipping_address' => fake()->address(),
            'payment_methods' => fake()->randomElement(['ABA', 'ACLEDA', 'BAKONG', 'CREDIT CARD']),
        ];
    }
}
