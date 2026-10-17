<?php

namespace Database\Seeders;

use App\Models\Category;
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
        Category::all()->each(function (Category $categories) {
            Product::factory(fake()->numberBetween(1, 10))->create([
                'categories_id' => $categories->categories_id
            ]);
        });
    }
}
