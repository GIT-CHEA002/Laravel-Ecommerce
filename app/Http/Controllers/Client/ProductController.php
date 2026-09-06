<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('client.products.index', ['products' => $products]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        dd(Product::findOrFail($product->product_id));
    }
}
