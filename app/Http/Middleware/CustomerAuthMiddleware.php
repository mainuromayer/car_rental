<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->isCustomer()) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
