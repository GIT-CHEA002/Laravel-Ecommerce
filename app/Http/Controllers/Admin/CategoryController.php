<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->simplePaginate(3);
        return view('admin.category.index', ['categories' => $categories]);
    }
    public function show(Category $category)
    {
        return view('admin.category.show', ['category' => $category]);
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        // validate
        // authorize 
        // save 
        // redirect
        dd("Save the data and redirect");
        return redirect()
            ->route('admin.category.index')
            ->withInput()
            ->with('success', 'Create new category successfully');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }
    public function update(Request $request, Category $category)
    {
        // search and confirm 
        // validate
        // save 
        // redirect
    }
    public function destroy(Request $request)
    {
        // confirm the destroy
        dd("Destroy the category items");
    }
    public function restore(Request $request)
    {
        // confirm
        // restore the soft delete data 
        // redirect
    }
    public function forceDelete(Request $request)
    {
        // confirm 
        // permanantly destroy data 
        // redirect 
    }
}
