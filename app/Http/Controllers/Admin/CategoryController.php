<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Categories::all();
        return $categories;
    }
    public function show(Categories $category)
    {
        dd(Categories::findOrFail($category->categories_id));
    }
    public function create()
    {
        dd("Create category form");
    }
    public function store(Request $request)
    {
        dd("Store the category");
    }
    public function edit()
    {
        dd("Edit the category form");
    }
    public function update(Request $request)
    {
        dd("To do update list");
    }
    public function destroy(Request $request)
    {
        dd("Destroy the category items");
    }
}
