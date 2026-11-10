<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $admins = User::where('role_id', 1)->latest('user_id')->limit(5)->get();
        $clients = User::where('role_id', 2)->latest('user_id')->limit(5)->get();
        $clientCount = User::where('role_id', 2)->count();
        $adminCount = User::where('role_id', 1)->count();
        return view(
            'admin.user.index',
            [
                'admins' => $admins,
                'clients' => $clients,
                'clientCount' => $clientCount,
                'adminCount' => $adminCount
            ]
        );
    }
    public function admin(Request $request)
    {
        $admins = User::where('role_id',)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereLike('user_id', "%" . trim($request->search) . "%")
                    ->orWhereLike('email', "%" . trim($request->search) . "%");
            })->when($request->filled('status'), function ($query) use ($request) {
                $query->where("is_active", trim($request->status));
            })->when($request->filled('sort'), function ($query) use ($request) {
                $query->orderBy($request->sort, $request->direction == 'desc' ? 'desc' : 'asc');
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();
        return view('admin.user.admin.index', ['admins' => $admins]);
    }
    public function client(Request $request)
    {
        $clients = User::where('role_id', 2)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereLike('user_id', "%" . trim($request->search) . "%")
                    ->orWhereLike('email', "%" . trim($request->search) . "%");
            })->when($request->filled('status'), function ($query) use ($request) {
                $query->where("is_active", trim($request->status));
            })->when($request->filled('sort'), function ($query) use ($request) {
                $query->orderBy($request->sort, $request->direction == 'desc' ? 'desc' : 'asc');
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();
        return $clients;
    }
    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
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
