<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

class SBAuth
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
        $uc = new UserController();
        if(!$uc->isLogged())
            return redirect()->route('admin');

        if(!$uc->isConfig())
            return redirect()->route('users');

        return $next($request);
    }
}
