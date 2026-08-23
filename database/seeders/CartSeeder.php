<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use Database\Factories\CartFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            Cart::factory()->create([
                'user_id' => $user->user_id
            ]);
        });
    }
}
