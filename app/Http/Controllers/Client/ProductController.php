<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->filled('category'), fn($q) =>
            $q->where('categories_id', $request->category))
            ->when($request->filled('max_price'), fn($q) =>
            $q->where('price', '<=', $request->max_price))
            ->when($request->filled('rating'), fn($q) =>
            $q->where('rating', '>=', $request->rating))
            ->paginate(10)
            ->withQueryString();
        $categories = $products->pluck('category')->unique('categories_id')->values();
        return view('client.products.index.index', ['products' => $products, 'categories' => $categories]);
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
