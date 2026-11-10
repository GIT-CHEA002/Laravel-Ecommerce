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
    public function index(Request $request)
    {
        $categories = Category::with('products')->get();
        $products = Product::with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereLike('name', '%' . trim($request->search) . '%');
            })
            // later we change to slug
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas("category", fn($c) => $c->where('name', $request->category));
            })
            ->when($request->filled('is_on_market'), function ($query) use ($request) {
                $query->where('is_on_market', $request->is_on_market);
            })
            ->latest()
            ->simplePaginate(5)
            ->withQueryString();
        return view('admin.product.index', ['products' => $products, 'categories' => $categories]);
    }

    public function show(Product $product)
    {
        return view('admin.product.show', ['product' => $product]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['categories' => $categories]);
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
