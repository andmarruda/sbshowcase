<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

        if($uc->isConfig() && !in_array(Route::currentRouteName(), ['users', 'logout', 'users.save'])){
            $_SESSION['sbshowcase']['isConfig'] = true;
            return redirect()->route('users');
        }

        return $next($request);
    }
}
