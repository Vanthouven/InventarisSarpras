<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (! $user || ! in_array($user->role, $roles)) {
            // Boleh pilih: abort(403) atau redirect
            return abort(403, 'Unauthorized.');
        }
        return $next($request);

                if (! $request->user() || ! in_array($request->user()->role, explode('|', $roles))) {
            abort(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
