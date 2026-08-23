<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Database\Factories\UserAddressFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // UserAddress::factory(2)->create();
        // assign to exist users 
        User::all()->each(function (User $user) {
            UserAddress::factory(fake()->numberBetween(2, 4))->create([
                'user_id' => $user->user_id
            ]);
        });
    }
}
