<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($role === 'student' && auth()->user()->isStudent()) {
            return $next($request);
        } elseif ($role === 'teacher' && auth()->user()->isTeacher()) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Unauthorized');
    }
}
