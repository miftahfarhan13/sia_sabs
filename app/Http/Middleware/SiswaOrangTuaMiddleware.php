<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Response;

class SiswaOrangTuaMiddleware
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
            if(Auth::user()->role != "Siswa" && Auth::user()->role != "Orang Tua"){
                return new Response(view('unauthorized')->with('role', 'Siswa'));
            }
        }else{
            return new Response(view('checklogin'));
        }
        
        return $next($request);
    }
}
