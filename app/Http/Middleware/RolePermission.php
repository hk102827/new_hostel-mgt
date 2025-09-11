<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolePermission
{
    public function handle($request, Closure $next, $permission = null)
    {
        // ✅ Agar user login nahi hai
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // ✅ Agar super-admin hai to hamesha allow karo
        if ($user->hasRole('super-admin')) {
            return $next($request);
        }

        // ✅ Agar koi permission di gayi hai to check karo
        if ($permission) {
            if ($user->can($permission)) {
                return $next($request);
            } else {
                abort(403, 'Access denied. You do not have the required permission.');
            }
        }

        // ✅ Agar permission null hai to allow karo
        return $next($request);
    }
}
