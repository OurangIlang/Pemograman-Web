<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restrict routes to specific roles.
 * Usage: ->middleware('role:admin') or ->middleware('role:admin,pegawai')
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (empty($roles)) {
            return $next($request);
        }

        if (! in_array($user->role, $roles, true)) {
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
