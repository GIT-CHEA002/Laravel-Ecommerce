<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'parent_categories_id' => null,
            'name' => fake()->unique()->randomElement([
                'Smart Phone',
                'Computer',
                'Electronics',
                'Laptop',
                'Camera',
                'Tablet',
            ]),
            'slug' => fake()->unique()->slug(),
            'image_url' => fake()->imageUrl()
        ];
    }
}
