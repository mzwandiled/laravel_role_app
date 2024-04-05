<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Agent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->role == 'agent')
        {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'user')
        {
            return redirect()->route('user.dashboard');
        }
        else
        {
            return redirect()->route('admin.dashboard');
        }
    }
}
