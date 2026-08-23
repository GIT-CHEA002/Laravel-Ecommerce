<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserAddress>
 */
class UserAddressFactory extends Factory
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
            'address_line' => fake()->address(),
            // 'user_id' => User::factory(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
        ];
    }
}
