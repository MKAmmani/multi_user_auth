<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is not authenticated or not an admin
        if (!auth()->check() || auth()->user()->role !== UserRole::Admin) {
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }

        // Allow admin users to proceed
        return $next($request);
    }
}