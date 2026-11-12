<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // call static method use "::". example User::where('active',1)->get();
    // call instance object use "->". example $user->delete(); = delete the user of the current instance

    public function index()
    {
        $categories = Category::with('products')->simplePaginate(5);
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function show(Category $category)
    {
        $categoryProduct = $category->products()->simplePaginate(5);
        return view('admin.category.show', ['category' => $category, 'products' => $categoryProduct]);
    }
    public function detachProduct(Category $category, Product $product)
    {
        // the product must belon to this category 
        abort_unless($product->categories_id == $category->categories_id, 404);
        $product->category()->disassociate();
        if ($product->save()) {
            return back()->with('success', 'Product removed from category successfully');
        }
        return back()->with('error', 'Failed to remove product from category');
    }
    public function attachProductIndex(Category $category)
    {
        $products = Product::whereDoesntHave('category', function ($query) use ($category) {
            $query->where('categories_id', $category->categories_id);
        })->simplePaginate(5);
        return view('admin.category.attach-product', ['category' => $category, 'products' => $products]);
    }
    public function attachProduct(Request $request, Category $category)
    {
        // validate 
        $data = $request->validate([
            'product_ids' => ['required', 'array'],
            'product_ids.*' => ['integer', 'exists:products,product_id']
        ]);
        try {
            Product::whereIn('product_id', $data['product_ids'])
                ->update(['categories_id' => $category->getKey()]);
            return redirect()->route('admin.category.show', $category)
                ->with('success', 'Products attached successfully.');
        } catch (Exception $e) {
            report($e);
            return back()
                ->with('error', 'Fail to attach product to category');
        }
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'  => ['required', 'string', 'min:5', 'max:255'],
            'slug'  => ['required', 'string', 'min:3', 'max:100'],
            'image' => ['required', 'url'],
        ]);

        $attributes['is_listing'] = $request->boolean('is_listing');

        try {
            Category::create([
                'name'       => $attributes['name'],
                'slug'       => $attributes['slug'],
                'image_url'  => $attributes['image'],
                'is_listing' => $attributes['is_listing']
            ]);

            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Category created successfully.');
        } catch (QueryException $e) {
            report($e);
            return back()
                ->withInput()
                ->with('error', 'Failed to create new category ');
        }
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $attributes = $request->validate([
            'name'  => ['required', 'string', 'min:5', 'max:255'],
            'slug'  => ['nullable', 'string', 'min:3', 'max:100'],
            'image' => ['required', 'url'],
        ]);

        try {
            $category->updateOrFail([
                'name'      => $attributes['name'],
                // 'slug'      => $attributes['slug'], // later update slug 
                'image_url' => $attributes['image'],
            ]);

            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Category updated successfully.');
        } catch (QueryException $e) {
            report($e);
            return back()
                ->withInput()
                ->with('error', 'Failed to update category ');
        }
    }

    public function destroy(Request $request, Category $category)
    {
        try {
            $category->updateOrFail(['is_listing' => false]);

            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Category deactivated successfully.');
        } catch (QueryException $e) {
            report($e);
            return back()
                ->withInput()
                ->with('error', 'Failed to deactivate category ');
        }
    }

    public function restore(Request $request, Category $category)
    {
        try {
            $category->updateOrFail(['is_listing' => true]);

            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Category restored successfully.');
        } catch (QueryException $e) {
            report($e);
            return back()
                ->withInput()
                ->with('error', 'Failed to restore category');
        }
    }

    public function forceDelete(Request $request, Category $category)
    {
        try {
            $category->deleteOrFail();
            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Category deleted permanently successfully.');
        } catch (QueryException $e) {
            report($e);
            return back()
                ->withInput()
                ->with('error', 'Failed to delete category: ');
        }
    }
}