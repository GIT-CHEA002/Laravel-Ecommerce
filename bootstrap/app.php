<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsClient;
use App\Http\Middleware\NoCache;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // protected route : by admin and client separately 
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
            'client' => EnsureUserIsClient::class,
            'nocache' => NoCache::class
        ]);
        $middleware->redirectGuestsTo(fn(Request $request) => route('login-user'));
        $middleware->redirectUsersTo(fn(Request $request) =>
        $request->user()->isAdmin() ?
            route('admin.dashboard') : route('client.home'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
