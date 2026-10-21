<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->simplePaginate(5);

        return view('admin.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'           => ['required', 'string', 'min:5', 'max:200', 'unique:products,name'],
            'price'          => ['required', 'numeric', 'min:0'],
            'description'    => ['required', 'string', 'min:10', 'max:2000'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'categories_id'  => ['nullable', 'exists:categories,categories_id'],
            'is_on_market'   => ['sometimes', 'boolean'],
        ]);

        $attributes['slug'] = Str::slug($attributes['name']);
        $attributes['is_on_market'] = $request->boolean('is_on_market');
        try {
            Product::create($attributes);
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product created successfully.');
        } catch (QueryException $e) {
            report($e);
            return back()
                ->withInput()
                ->with('error', 'Failed to create new product!');
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'name'           => ['required', 'string', 'min:5', 'max:200'],
            'price'          => ['required', 'numeric', 'min:0'],
            'description'    => ['required', 'string', 'min:10', 'max:2000'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'categories_id'  => ['nullable', 'exists:categories,categories_id'],
            'is_on_market'   => ['sometimes', 'boolean'],
        ]);

        $attributes['slug'] = Str::slug($attributes['name']);
        $attributes['is_on_market'] = $request->boolean('is_on_market');

        try {
            $product->updateOrFail($attributes);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product updated successfully.');
        } catch (QueryException $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Failed to update product!');
        }
    }

    public function destroy(Request $request, Product $product)
    {
        try {
            $product->updateOrFail(['is_on_market' => false]);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product deactivated successfully.');
        } catch (QueryException $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Failed to deactivate the product!');
        }
    }

    public function restore(Request $request, Product $product)
    {
        try {
            $product->updateOrFail(['is_on_market' => true]);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product restored successfully.');
        } catch (QueryException $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Failed to activate the product!');
        }
    }

    public function forceDelete(Request $request, Product $product)
    {
        try {
            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product deleted permanently.');
        } catch (QueryException $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Failed to delete this product from the database.');
        }
    }
}
