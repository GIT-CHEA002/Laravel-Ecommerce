<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index(Request $request)
  {
    // get the categoryId by request 
    $categoryId = $request->query('category');

    $products = Product::query()
      ->when($categoryId, fn($query) => $query->where('categories_id', $categoryId))
      ->paginate(6)
      ->withQueryString();

    // get all category
    $categories = Categories::withCount('products')->get();

    return view('client.category.category', ['categories' => $categories, 'products' => $products, 'categoryId' => $categoryId]);
    // return $catetories;
  }
}
