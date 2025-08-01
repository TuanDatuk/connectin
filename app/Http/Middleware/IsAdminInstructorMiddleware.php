<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminInstructorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id != 3) {
                return $next($request);
            } else {
                return redirect()->route('home');
            }
        }

        return redirect()->route('login');
    }
}
