<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(!Auth::check()){
            return redirect('/login');
        }

        $user = Auth::user();

        if($user->role==1){
            return redirect('/superadmin');
            
        }
        if($user->role==2)
        {
            return $next($request);
        }
        if($user->role==3)
        {
            return redirect('/referee');
        }
        if($user->role==4)
        {
            return redirect('/teamadmin');
        }
        if($user->role==5)
        {
            return redirect('/normaluser');
        }
    }
}
