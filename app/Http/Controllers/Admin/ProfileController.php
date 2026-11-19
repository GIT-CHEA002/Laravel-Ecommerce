<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ProfileController extends Controller
{
  use AuthorizesRequests;
  public function index()
  {
    $user = Auth::user();
    return view('admin.profile.index', ['user' => $user]);
  }
  public function edit(User $user)
  {
    return view('admin.profile.setting', ['user' => $user]);
  }

  public function updateProfile(Request $request, User $user)
  {
    // authorize : done in route
    $this->authorize('updateProfile', $user);
    // validate fielde 
    $attributes = $request->validate([
      // general info (user table)
      'first_name' => ['required', 'string', 'min:3', 'max:254'],
      'last_name' => ['required', 'string', 'min:3', 'max:254'],
      'phone' => ['required', 'string'],
      'avatar' => ['nullable', 'url'],

      // address (user_addresses table)
      'user_addresses.address_line' => ['nullable', 'string', 'min:3', 'max:255'],
      'user_addresses.city' => ['nullable', 'string', 'min:3'],
      'user_addresses.postal_code' => ['nullable', 'string'],
      'user_addresses.is_default' => ['nullable', 'boolean'],
    ]);
    if (isset($attributes['user_addresses'])) {
      $attributes['user_addresses']['is_default'] = $request->boolean('user_addresses.is_default');
    }
    // save : use DB transaction with closure to ensure more than one operation of query work well together otherwise rollbac
    try {
      // save
      DB::transaction(function () use ($user, $attributes) {
        // the closure 
        $user->updateOrFail(Arr::except($attributes, 'user_addresses'));
        $user->addresses()->updateOrCreate([], $attributes['user_addresses']);
      });
      // redirect
      return redirect()
        ->route('admin.profile.index', $user)
        ->with('success', 'Update Admin Information successfully');
    } catch (Exception $e) {
      report($e);
      // redirect if fails
      return  back()
        ->with('error', 'Fail to update admin information' . $e);
    }
  }
}
