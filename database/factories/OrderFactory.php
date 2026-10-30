<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Override;
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
            'total_amount' => 10000,
            'order_number' => Order::clearBootedModels(),
            'status' => fake()->randomElement(['shipping', 'pending', 'arrived']),
            'shipping_address' => fake()->address(),
            'payment_methods' => fake()->randomElement(['ABA', 'ACLEDA', 'BAKONG', 'CREDIT CARD']),
        ];
    }
    #[Override]
    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
            $order->order_number = 'ORD-' . str_pad($order->order_id, 3, 0, STR_PAD_LEFT);
            $order->save();
        });
    }
}
