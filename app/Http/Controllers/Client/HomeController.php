<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
  public function index()

  {
    $featuredProduct = Product::inRandomOrder()->take(10)->get();
    return view('client.home', ['featuredProduct' => $featuredProduct]);
  }
  public function show() {}
  public function categories()
  {
    // return some categories
  }
}
