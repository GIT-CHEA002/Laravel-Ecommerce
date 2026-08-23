<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Categories::all()->each(function (Categories $categories) {
            Product::factory(fake()->numberBetween(1, 5))->create([
                'categories_id' => $categories->categories_id
            ]);
        });
    }
}
