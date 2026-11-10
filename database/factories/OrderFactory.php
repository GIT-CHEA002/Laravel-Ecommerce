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
            'order_number' => null, // generate in the model event
            // money 
            'subtotal' => 0, // recalculate from orderProduct(sum of line_total)
            'discount_amount' => 0, // set once with discount (at purchase event)
            'shipping_fee' => fake()->randomElement([0, 1.2, 3.4, 6]), // fake generate
            'tax_amount' => 0, // recaculate from the orders lines 
            'total_amount' => 0,
            'currency' => 'USD',

            // state and status : 
            'status' => fake()->randomElement(['pending', 'processing', 'shipping', 'delivered', 'cancelled', 'refuned']),

            // payment methods : 
            'payment_methods' => fake()->randomElement(['ABA', 'ACLEDA', 'BAKONG', 'CREDIT CARD', 'CODE']),
            'payment_status' => 'unpaid',
            'payment_reference' => null,

            // shipping information

            'shipping_name' => fake()->name(),
            'shipping_phone' => fake()->phoneNumber(),
            'shipping_address' => fake()->address(),
            'shipping_note' => fake()->optional(0.3)->sentence(),

            // timestamp
            'paid_at' => null,
            'shipping_at' => null,
            'delivered_at' => null,
            'cancelled_at' => null,
        ];
    }
    // #[Override]
    // public function configure(): static
    // {
    //     return $this->afterCreating(function (Order $order) {
    //         $order->order_number = 'ORD-' . str_pad($order->order_id, 3, 0, STR_PAD_LEFT);
    //         $order->save();
    //     });
    // }
}
