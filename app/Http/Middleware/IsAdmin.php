<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->role == "admin") {
                return $next($request);
            } else {
                // Redirect non-admin users to a specific route or page
                return redirect("redirect");
            }
        }

        // Handle the case where the user is not authenticated
        return redirect()->route('login');
    }
}
