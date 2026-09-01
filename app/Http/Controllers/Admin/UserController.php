<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = User::all();
        dd($user);
    }
    public function show(User $user)
    {
        dd($user::findOrFail($user->user_id));
    }
    public function create()
    {
        dd("Create User Form (Admin's work only) ");
    }
    public function store(Request $request)
    {
        dd("Store the User in the database");
    }
    public function edit()
    {
        dd("Return edit form of the user (include fields)");
    }
    public function update(Request $request)
    {
        dd("Store and save the user in the database");
    }
    public function destroy(Request $request)
    {
        dd("Destroy the User ");
    }
}
