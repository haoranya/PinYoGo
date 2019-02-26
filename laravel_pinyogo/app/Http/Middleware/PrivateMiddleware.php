<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Pv;

class PrivateMiddleware
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

        $path = $_SERVER['PATH_INFO'];

        if(session()->get('root')){

            $data = Pv::where('pv',$path)->where('manager_id',session()->get('manager_id'))->first();

            if(!$data){

                Pv::insert(['pv'=>$path,'manager_id'=>session()->get('manager_id')]);

            }

            return $next($request);

        }

        $private = session()->get('private');

        $private_arr = explode(',',$private);

        array_pop($private_arr);

        if(in_array($path,$private_arr)){

            $data = Pv::where('pv',$path)->where('manager_id',session()->get('manager_id'));

            if(!$data){

                Pv::insert(['pv'=>$path,'manager_id'=>session()->get('manager_id')]);

            }

            return $next($request);

        }else{

            dd("无权访问");

        }

        
    }
}
