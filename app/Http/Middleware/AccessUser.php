<?php

namespace ORC\Http\Middleware;
use Auth;
use Closure;

class AccessUser
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
        if(Auth::user()->hasAnyRole('user')){
            return $next($request);
        }
        return redirect('home');        
    }  
}
