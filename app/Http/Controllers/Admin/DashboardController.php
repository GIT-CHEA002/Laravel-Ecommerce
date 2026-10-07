<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  //
  public function index()
  {
    return view('admin.dashboard.dashboard', ['Data' => 'Hello Dashboard data']);
  }
}
