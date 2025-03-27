<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
         
            Log::info('JWT Middleware - Request Headers', [
                'authorization' => $request->header('Authorization')
            ]);


            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                Log::warning('JWT Middleware - User not found');
                return response()->json(['message' => 'User not found'], 404);
            }

            return $next($request);

        } catch (\Exception $e) {

            Log::error('JWT Middleware Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Unauthorized',
                'error' => $e->getMessage()
            ], 401);
        }
    }
}
