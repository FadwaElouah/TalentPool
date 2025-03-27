<?php

namespace App\Http\Middleware;
use App\Models\UserRole;
use Tymon\JWTAuth\Facades\JWTAuth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user || $user->role !== 'admin') {
                return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
