<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class EnsureUserIsRecruiter
{
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || $user->role !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
