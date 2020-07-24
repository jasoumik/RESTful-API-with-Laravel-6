<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AuthBasic
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
        //???????? auth basic dont response json.showing exception. why?
        if(Auth::onceBasic()){
            return response()->json(['msg'=>'Auth Failed'],401);
        }
        else{
            return $next($request);
        }
        
    }
}
