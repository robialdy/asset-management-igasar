<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDivisionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $divisionName = $request->route('division');

        if (!Auth::check() || !Auth::user()->id_division || Auth::user()->division->name !== $divisionName) {
            abort(404);
        }

        return $next($request);
    }
}
