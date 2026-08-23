<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categories>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_categories_id' => Categories::query()
                ->inRandomOrder()
                ->value('categories_id'),
            'name' => fake()->randomElement([
                'Smart Phone',
                'Computer',
                'Electronics',
                'Laptop',
                'Camera',
                'Tablet',
            ]),
            'slug' => fake()->unique()->slug(),
        ];
    }
}
