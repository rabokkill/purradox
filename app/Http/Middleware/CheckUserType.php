<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $user_type): Response
    {
        if (Auth::check()){
            if (Auth::user()->user_type == $user_type){
                return $next($request);
            }
            abort(403); // forbidden
        }

        abort(401); // unauthorized
    }
}
