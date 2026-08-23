<?php

namespace Database\Seeders;

use App\Models\Categories;
use Database\Factories\CategoriesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::factory(10)->hasChildren(3)->create();
    }
}
