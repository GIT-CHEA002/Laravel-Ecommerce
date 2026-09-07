<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;

class HomeController extends Controller
{
  public function index()
  {
    $featuredProduct = Product::inRandomOrder()->take(12)->get();
    $featuredCategories = Categories::inRandomOrder()->take(4)->get();
    return view('client.home.home', ['featuredProduct' => $featuredProduct, 'featuredCategories' => $featuredCategories]);
  }
}
