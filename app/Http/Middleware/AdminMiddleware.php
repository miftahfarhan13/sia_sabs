<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->role != "Admin"){
                return new Response(view('unauthorized')->with('role', 'Admin'));
            }
        }else{
            return new Response(view('checklogin'));
        }
        
        return $next($request);
    }
}
