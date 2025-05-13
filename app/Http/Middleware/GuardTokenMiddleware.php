<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GuardTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Try user guard
        if (Auth::guard('api')->check()) {
            Auth::shouldUse('api');
        }

        // Try employee guard
        elseif (Auth::guard('employee_api')->check()) {
            Auth::shouldUse('employee_api');
        }

        return $next($request);    }
}
