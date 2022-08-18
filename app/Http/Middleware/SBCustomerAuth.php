<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAreaController;

if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

class SBCustomerAuth
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
        $ca = new CustomerAreaController();
        if(!$ca->isLogged())
            return redirect()->route('customer-login', ['redirect' => Route::currentRouteName()]);

        return $next($request);
    }
}
