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
        $product = Product::with('category')->get();
        return $product;
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $products  = Product::findOrFail($product->product_id);
        dd($products);
    }
}
