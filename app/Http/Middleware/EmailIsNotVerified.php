<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Symfony\Component\HttpFoundation\Response;

class EmailIsNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->isUser) {
            $redirect = RouteServiceProvider::HOME;
        }elseif ($request->user()->isAdmin) {
            $redirect = RouteServiceProvider::ADMINHOME;
        }

        if (! $request->user() ||
        ($request->user() instanceof MustVerifyEmail && $request->user()->hasVerifiedEmail())) {
            return redirect($redirect);
        }

        return $next($request);
    }
}
