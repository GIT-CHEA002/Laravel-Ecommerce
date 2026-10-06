<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Email;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    //
    public function create()
    {
        return view('auth.login');
    }
    // login user or attempt
    // check authorization
    // check if login or not , then throw validate 
    // regenerate the session token 
    // redirect to the specific resources
    public function store(Request $request)
    {
        $attributes  = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }
        $request->session()->regenerate();
        $landing = $request->user()->isAdmin() ? route('admin.dashboard') : route('client.home');
        return redirect()->intended($landing);
    }
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        // invalid token check
        $request->session()->invalidate();
        // regenerate the token 
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
