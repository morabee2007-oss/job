<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($request->routeIs('dashboard')) {
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                if ($user->role === 'employer') {
                    return redirect()->route('employer.dashboard');
                }

                if ($user->role === 'candidate') {
                    return redirect()->route('candidate.dashboard');
                }
            }
        }

        return $next($request);
    }
}
