<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $product = Product::all();
        return $product;
    }
    public function show(Product $product)
    {
        // should show specific products
        dd(Product::findOrFail($product->product_id));
    }
    public function create()
    {
        dd("create form of admin layout");
    }
    public function store(Request $request)
    {
        // validate 
        // check authorized
        // save 
        // redirect
        dd("Redirect to dashboard");
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
