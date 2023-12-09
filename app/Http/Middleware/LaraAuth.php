<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use  Illuminate\Support\Facades\Auth;

class LaraAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (Auth::check()) {
                $laraRole = Auth::user()->role;
    
                if ($laraRole == 1 || $laraRole == 0 || $laraRole == 2) {
                    return $next($request);
                }
            }

            return redirect()->route('login');
        } catch (\Throwable $th) {
            return response('Internal Server Error', 500);
        }
        

        
       
    }
}
