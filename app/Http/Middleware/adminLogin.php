<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class adminLogin
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
        dd(Auth::guard('admin')->user());
        if(Auth::guard('admin')-> check()){
            return $next($request);
        }else{
            return redirect()->route('user.userLoginRegister');
        }
    }
}
