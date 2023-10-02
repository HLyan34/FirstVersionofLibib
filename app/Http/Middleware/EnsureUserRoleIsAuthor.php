<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRoleIsAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ((auth()->user()->user_role === 'admin' || auth()->user()->user_role === 'author')) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'You do not have access to this page.');
    }
}
