<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CategorySeeder extends Seeder
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
        // foreach ($this->name as $name) {
        //     $parent = Category::factory()->create([
        //         'parent_categories_id' => null,
        //         'name' => $name
        //     ]);
        //     $childrens = fake()->unique()->words(3);
        //     foreach ($childrens as $children) {
        //         Category::factory()->create([
        //             'parent_categories_id' => $parent->categories_id,
        //             'name' => $children
        //         ]);
        //     }
        // }
        Category::factory(6)->create();
    }
}
