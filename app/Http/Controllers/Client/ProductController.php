<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')
            ->simplePaginate(9)
            ->withQueryString();
        $categories = $products->pluck('category')->unique('categories_id')->values();
        return view('client.products.index', ['products' => $products, 'categories' => $categories]);
    }

    /**
     * Display the specified resource.
     * public function index(Request $request)
     */
    public function show(Product $product)
    {
        dd(Product::findOrFail($product->product_id));
    }
}
