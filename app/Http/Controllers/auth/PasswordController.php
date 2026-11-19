<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
  use AuthorizesRequests;
  public function edit(Request $request)
  {
    $view = $request->user()->isAdmin()
      ? 'admin.profile.change-password'
      : 'auth.reset-password';
    return view($view);
  }
  public function update(Request $request)
  {

    $attributes = $request->validate([
      'old_password' => ['required', 'current_password'],
      'new_password' => ['required', 'confirmed', Password::defaults()],
    ]);
    try {
      $request->user()->update([
        'password' => Hash::make($attributes['new_password'])
      ]);
      $redirect =  $request->user()->isAdmin()
        ? 'admin.profile.index'
        : 'client.profile.index';
      return redirect()
        ->route($redirect)
        ->with('success', 'Password update successfull');
    } catch (Exception $e) {
      report($e);
      return back()
        ->with('error', 'Can not update current password');
    }
  }
}
