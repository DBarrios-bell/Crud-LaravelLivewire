<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\ResponseController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAuth
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
        if(!Auth::guard()->user()){
            return ResponseController::Error('Acceso No Autorizado',401);
        }
        return $next($request);

        //return $request->guard();
        //return $next($request);
    }
}
