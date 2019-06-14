<?php

namespace App\Http\Middleware;

use Closure;


/**
 *  Added to remove CORS requirement for remote access (for now).
 *
 *  @author Steve Juth
 */
class Cors {

    /**
     *  Handles an incoming request
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Closure  $next
     *  @return mixed
     */
    public function handle($request, Closure $next) {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
