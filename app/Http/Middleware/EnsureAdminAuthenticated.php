<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('admin_authenticated')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            // Di subdomain admin: redirect ke /login. Di path /admin: redirect ke /admin/login
            $adminDomain = config('admin.domain');
            if ($adminDomain && $request->getHost() === $adminDomain) {
                return redirect()->guest(url('/login'));
            }
            return redirect()->guest(route('admin.login'));
        }

        return $next($request);
    }
}
