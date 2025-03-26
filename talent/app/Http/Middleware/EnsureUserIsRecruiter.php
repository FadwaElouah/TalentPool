<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsRecruiter
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isRecruiter()) {
            return response()->json(['message' => 'Unauthorized. Recruiter access required.'], 403);
        }

        return $next($request);
    }
}


