<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class employee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
if (Auth::guard('employee')->check() || Auth::guard('employee-api')->check()) {
    return $next($request);
}

    return redirect()->route('login')->with('error', 'Unauthorized User, Login to Continue!!');
    }
    
}
