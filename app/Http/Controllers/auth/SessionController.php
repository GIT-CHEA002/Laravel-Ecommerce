<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        dd("Log the user in");
    }

    public function destroy()
    {
        // check the credential
        // attempt to log out (or destroy the credential)
        // redirect to the home page
        dd("Log the user out ");
    }
}
