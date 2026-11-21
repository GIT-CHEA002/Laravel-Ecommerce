<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class SignInWithGoogleController extends Controller
{
  public function redirect()
  {
    // dd("hello kon papa , sign in with google tv kon");
    return Socialite::driver('google')
      ->with(['prompt' => 'select_account'])
      ->redirect();
  }
  public function callback()
  {
    $googleUser = null;
    try {
      $googleUser = Socialite::driver('google')->user();
    } catch (Exception $e) {
      report($e);
    }
    // if find exist email , just merge them and if not register new
    $user = User::where('google_id', $googleUser->getId())
      ->orWhere('email', $googleUser->getEmail())
      ->first();
    if ($user) {
      $user->update([
        'google_id' => $googleUser->getId(),
        'avatar' => $googleUser->getAvatar()
      ]);
    } else {
      $user = User::create([
        'first_name' => $googleUser->user['given_name'] ?? 'Jonh',
        'last_name' => $googleUser->user['family_name'],
        'google_id' => $googleUser->getId(),
        'email' => $googleUser->getEmail(),
        'avatar' => $googleUser->getAvatar(),
        'password' => null,
        'email_verified_at' => now()
      ]);
    }
    Auth::login($user, remember: true);
    return redirect()
      ->intended('/');
  }
}
