<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
  public function create(Request $request, String $token)
  {
    $landing = $request->routeIs('auth.admin.password.reset') ? 'admin.profile.reset-password' : 'auth.reset-password';
    return view(
      $landing,
      [
        'token' => $token,
        'email' => $request->query('email')
      ]
    );
  }
  public function store(Request $attributes)
  {
    // validate 
    // resetUser 
    $attributes =   $attributes->validate([
      'token' => ['required', 'string'],
      'email' => ['required', 'email'],
      'password' => ['required', 'confirmed', Password::defaults()]
    ]);
    dd($attributes);
  }
}
