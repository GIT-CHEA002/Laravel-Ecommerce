<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
  public function create(Request $request, String $token)
  {
    return view('auth.reset-password', [
      'token' => $token,
      'email' => $request->query('email')
    ]);
  }
  public function store(Request $request)
  {
    $validated = $request->validate([
      'token' => ['required', 'string'],
      'email' => ['required', 'email'],
      'password' => ['required', 'confirmed', Password::defaults()]
    ]);
    $status = FacadesPassword::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
        $user->forceFill([
          'password' => Hash::make($password),
          'remember_token' => Str::random(60),
        ])->save();
        event(new PasswordReset($user));
      }
    );
    return $status === FacadesPassword::PASSWORD_RESET
      ? redirect()->route('auth.login')->with('succes', __($status))
      : back()->withErrors(['error' => __($status)]);
  }
}
