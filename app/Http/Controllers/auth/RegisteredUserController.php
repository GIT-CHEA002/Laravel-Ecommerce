<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisteredUserController extends Controller
{
    // return register form
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        dd("Store the users");
        // validate 
        // check authenticate
        // store user 
        // redirect
    }
}
