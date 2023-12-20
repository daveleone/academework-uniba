<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated and has the required role
        if ($request->user() && $request->user()->hasAnyRole(...$roles)) {
            return $next($request);
        }

        // Redirect if the user doesn't have the required role
        if ($request->user() && $request->user()->hasAnyRole('student') && in_array('teacher', $roles)) {
            return redirect()->route('dashboard');
        }
    }
}
