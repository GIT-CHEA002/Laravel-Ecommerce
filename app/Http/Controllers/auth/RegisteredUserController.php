<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Email;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'firstname' => ['required', 'min:3', 'max:254'],
            'lastname' => ['required', 'min:3', 'max:254'],
            'email' => ['required', 'email', Email::default()],
            'password' => ['required', 'min:8', 'max:254', 'confirmed', Password::default()],
        ]);
        $user = DB::transaction(function () use ($attributes) {
            $user = User::create([
                'first_name' => $attributes['firstname'],
                'last_name' => $attributes['lastname'],
                'email' => $attributes['email'],
                'password' => $attributes['email'],
            ]);
            return $user;
        });
        Auth::login($user);
        return redirect('/');
    }
}
