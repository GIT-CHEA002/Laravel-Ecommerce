<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

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
        // validate 
        // check authorized
        // save 
        // redirect
        dd("Redirect to dashboard");
        return redirect()->route('admin.products.index');
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
