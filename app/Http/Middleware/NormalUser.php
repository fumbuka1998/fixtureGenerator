<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NormalUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        if(!Auth::check()){
            return redirect('/login');
        }

        $user= Auth::user();

        if($user->role==1){
            return redirect('/superAdmin');
            
        }
        if($user->role==2)
        {
            return redirect('/admin');
        }
        if($user->role==3)
        {
            return redirect('/referee');
        }
        if($user->role==4)
        {
            return redirect('/teamAdmin');
        }
        if($user->role==5)
        {
            return $next($request);
        }
    }
}
