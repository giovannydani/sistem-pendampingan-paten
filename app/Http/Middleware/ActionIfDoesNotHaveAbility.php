<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActionIfDoesNotHaveAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $userRole = Auth::user()->role->value;
        $roles = explode('|', $roles);

        foreach ($roles as $role) {
            if ($userRole === $role) {
                return $next($request);
            }
        }

        // return $next($request);
        return abort(404);
    }
}
