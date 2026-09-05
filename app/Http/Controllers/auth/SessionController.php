<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Email;
use Illuminate\Validation\Rules\Password;

class SessionController extends Controller
{
    //
    public function create()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        // login user or attempt
        // check authorization
        // check if login or not , then throw validate 
        // regenerate the session token 
        // redirect to the specific resources

        $attributes = $request->validate([
            'email' => [
                'required',
                Email::default(),
                'password' => ['required', Password::default()]
            ]
        ]);
        if ($attributes) {
            dd($attributes);
        }
    }

    public function destroy(Request $request)
    {
        // check the credential
        // attempt to log out (or destroy the credential)
        // redirect to the home page
        dd("Log the user out ");
        Auth::logout();
        return redirect('/');
    }
}
