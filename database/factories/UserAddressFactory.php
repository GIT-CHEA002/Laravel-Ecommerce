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
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
        ];
    }
    public function default()
    {
        return $this->state(fn() => ['is_default' => true]);
    }
}
