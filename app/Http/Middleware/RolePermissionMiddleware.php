<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolePermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permission = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Agar koi specific permission required hai aur user ke paas nahi hai
        if ($permission && !$user->can($permission)) {
            abort(403, 'Access denied. You do not have the required permission.');
        }

        return $next($request);
    }
}
