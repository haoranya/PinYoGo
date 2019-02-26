<?php

namespace App\Http\Middleware;

use Closure;

class Front
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

        if(session()->get('id')==null){

           header("Location:Front_login");

        }

        return $next($request);
    }
}
