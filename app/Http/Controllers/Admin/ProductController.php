<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('category')->simplePaginate(5);
        return view('admin.product.index', ['products' => $products]);
    }
    public function show(Product $product)
    {
        // should show specific products

        dd(Product::findOrFail($product->product_id));
    }
    public function create()
    {
        $category = Categories::all();
        return view('admin.product.create', ['category' => $category]);
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
        $product = Product::create($attributes);
        if ($product) {
            return redirect()->route('admin.products.index');
        } else {
            abort(401);
        }
    }
    public function edit(Product $product)
    {
        dd($product::findOrFail($product->product_id), "Edit product form");
    }
    public function update(Request $request)
    {
        dd("Redirect to the product it self");
    }
}
