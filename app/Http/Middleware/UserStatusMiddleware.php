<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class UserStatusMiddleware
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
        $user = Auth::user();
        if($user->status == 'approved')
        {
            return $next($request);

        }else{

            Auth::logout();
            return redirect()->guest('login')->withErrors(['email' => 'Unapproved Account!']);
        }
    }
}
