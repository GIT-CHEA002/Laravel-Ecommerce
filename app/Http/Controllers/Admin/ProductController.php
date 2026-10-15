<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->simplePaginate(5);
        return view('admin.product.index', ['products' => $products]);
    }
    public function show(Product $product)
    {
        return view('admin.product.show', ['product' => $product]);
    }
    public function create()
    {
        $categories = Categories::all();
        return view('admin.product.create', ['categories' => $categories]);
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'           => ['required', 'string', 'min:5', 'max:200', 'unique:products,name'],
            'price'          => ['required', 'numeric', 'min:0'],
            'description'    => ['required', 'string', 'min:10', 'max:2000'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'categories_id' => ['nullable', 'exists:categories,categories_id'],
            'is_on_market'   => ['sometimes'],
        ]);
        $attributes['slug'] = \Illuminate\Support\Str::slug($attributes['name']);
        $attributes['is_on_market'] = $request->boolean('is_on_market');
        // step 2 : need to attach image
        $product = Product::create($attributes);
        if ($product) {
            return redirect()->route('admin.products.index')->with('success', 'create product successfully');
        } else {
            return back()->withInput()->with('error', 'fails to add new product ');
        }
    }
    public function edit(Product $product)

    {
        $categories = Categories::all();
        return view('admin.product.edit', ['product' => $product, 'categories' => $categories]);
    }
    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'name'           => ['required', 'string', 'min:5', 'max:200'],
            'price'          => ['required', 'numeric', 'min:0'],
            'description'    => ['required', 'string', 'min:10', 'max:2000'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'categories_id' => ['nullable', 'exists:categories,categories_id'],
            'is_on_market'   => ['sometimes'],
        ]);
        $attributes['slug'] = \Illuminate\Support\Str::slug($attributes['name']);
        $attributes['is_on_market'] = $request->boolean('is_on_market');
        $isUpdate = $product->updateOrFail($attributes);
        if ($isUpdate) {
            return redirect()->route('admin.products.index')->with('success', 'product update successfully');
        } else {
            return back()->withInput()->withErrors('error', 'Fails to update the current product.');
        }
    }
    public function destroy(Request $request, Product $product)
    {
        $isDelete = $product->updateOrFail(['is_on_market' => false]);
        if ($isDelete) {
            return redirect()->route('admin.products.index')->with('success', 'Soft delete product successfully');
        } else {
            return back()->withInput()->with('error', 'Fail to update the current product.');
        }
    }
    public function restore(Request $request, Product $product)
    {
        $isRestored = $product->updateOrFail(['is_on_market' => true]);
        if ($isRestored) {
            return redirect()->route('admin.products.index')->with('success', 'Product restore successfully');
        } else {
            return back()->withInput()->with('error', 'Fail to restore this product.');
        }
    }
    public function forceDelete(Request $request, Product $product)
    {
        $isDeleted = $product->delete();
        if ($isDeleted) {
            return redirect()->route('admin.products.index')->with('success', 'Force delete successfully , it gone!');
        } else {
            return back()->withInput()->with('error', 'Can not force delete this product!');
        }
    }
}
