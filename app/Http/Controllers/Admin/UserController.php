<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use AuthorizesRequests;
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
    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
    }
    public function admin(Request $request)
    {
        $admins = User::where('role_id', 1)
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = '%' . trim($request->search) . '%';
                $query->where(function ($c) use ($search) {
                    $c->whereLike('first_name', $search)
                        ->orWhereLike('last_name', $search)
                        ->orWhereLike('email', $search);
                });
            })->when($request->filled('status'), function ($query) use ($request) {
                $query->where("is_active", trim($request->status));
            })->when($request->filled('sort'), function ($query) use ($request) {
                // direction and sort
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
                $search = '%' . trim($request->search) . '%';
                $query->where(function ($c) use ($search) {
                    $c->whereLike('first_name', $search)
                        ->orWhereLike('last_name', $search)
                        ->orWhereLike('email', $search);
                });
            })->when($request->filled('status'), function ($query) use ($request) {
                $query->where("is_active", trim($request->status));
            })->when($request->filled('sort'), function ($query) use ($request) {
                // direction and sort
                $query->orderBy($request->sort, $request->direction == 'desc' ? 'desc' : 'asc');
            })
            ->paginate(6)
            ->withQueryString();
        return view('admin.user.client.index', ['clients' => $clients]);
    }
    public function edit(User $user)
    {
        return view('admin.user.admin.edit-admin', ['user' => $user]);
    }
    public function update(Request $request, User $user)
    {
        // authorize : done in route 
        // validate fielde 
        $attributes = $request->validate([
            // general info (user table)
            'first_name' => ['required', 'string', 'min:5', 'max:254'],
            'last_name' => ['required', 'string', 'min:5', 'max:254'],
            'phone' => ['required', 'string'],
            'avatar' => ['nullable', 'url'],

            // address (user_addresses table)
            'user_addresses.address_line' => ['nullable', 'string', 'min:3', 'max:255'],
            'user_addresses.city' => ['nullable', 'string', 'min:3'],
            'user_addresses.postal_code' => ['nullable', 'string'],
            'user_addresses.is_default' => ['nullable', 'boolean'],
        ]);
        // save : use DB transaction with closure to ensure more than one operation of query work well together otherwise rollbac
        try {
            // save
            DB::transaction(function () use ($user, $attributes) {
                // the closure 
                $user->updateOrFail(Arr::except($attributes, 'user_addresses'));
                $user->addresses()->updateOrCreate([], $attributes['user_addresses']);
            });
            // redirect
            return redirect()
                ->route('admin.user.admin.show', $user)
                ->with('success', 'Update Admin Information successfully');
        } catch (Exception $e) {
            report($e);
            // redirect if fails
            return  back()
                ->with('error', 'Fail to update admin information' . $e);
        }
    }

    public function create()
    {
        return view('admin.customer.create');
    }
    public function store(Request $request)
    {
        dd("Store the User in the database");
    }
    public function destroy(Request $request)
    {
        dd("Destroy the User ");
    }
}
