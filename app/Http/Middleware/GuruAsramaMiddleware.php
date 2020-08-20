<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Response;

class GuruAsramaMiddleware
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
            if(Auth::user()->role != "Guru Asrama"){
                return new Response(view('unauthorized')->with('role', 'Guru Asrama'));
            }
        }else{
            return new Response(view('checklogin'));
        }
        
        return $next($request);
    }
}
