<?php

namespace App\Http\Middleware;

use Closure;

class CekLogin
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
        if(empty(session('level'))){
            return redirect ("login")->with("error","Silahkan login dulu");
            
        }
        

        return $next($request);
    }
}
