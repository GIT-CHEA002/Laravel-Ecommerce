<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Database\Factories\OrderFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::all()->each(function (User $user) {
            Order::factory(fake()->numberBetween(1, 2))->create([
                'user_id' => $user->user_id
            ]);
        });
    }
}
