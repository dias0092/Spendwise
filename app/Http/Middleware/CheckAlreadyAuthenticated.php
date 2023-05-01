<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckAlreadyAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            return response()->json(['message' => 'You are already logged in.'], 400);
        }

        return $next($request);
    }
}
