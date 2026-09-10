<?php

namespace Database\Seeders;

use App\Models\Categories;
use Database\Factories\CategoriesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected array $name = [
        'Smart Phone',
        'Computer',
        'Electronics',
        'Laptop',
        'Camera',
        'Tablet'
    ];
    public function run(): void
    {
        foreach ($this->name as $name) {
            $parent = Categories::factory()->create([
                'parent_categories_id' => null,
                'name' => $name
            ]);
            $childrens = fake()->unique()->words(3);
            foreach ($childrens as $children) {
                Categories::factory()->create([
                    'parent_categories_id' => $parent->categories_id,
                    'name' => $children
                ]);
            }
        }
    }
}
