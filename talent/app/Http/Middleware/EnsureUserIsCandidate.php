<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCandidate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isCandidate()) {
            return response()->json(['message' => 'Unauthorized. Candidate access required.'], 403);
        }

        return $next($request);
    }
}
