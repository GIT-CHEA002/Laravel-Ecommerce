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
        $admins = User::where('role_id', 1)->get();
        $clients = User::where('role_id', 2)->simplePaginate();
        $users = User::simplePaginate(10);
        return view('admin.customer.index', ['users' => $users, 'admins' => $admins, 'clients' => $clients]);
    }
    public function show(User $user)
    {
        dd($user::findOrFail($user));
        return view('admin.customer.show', ['user' => $user]);
    }
    public function create()
    {
        return view('admin.customer.create');
    }
    public function store(Request $request)
    {
        // validate
        // authorization
        // save and attach 
        // redirect
        dd("Store the User in the database");
    }
    public function destroy(Request $request)
    {
        dd("Destroy the User ");
    }
}
