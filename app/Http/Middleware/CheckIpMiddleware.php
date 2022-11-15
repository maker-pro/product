<?php

namespace App\Http\Middleware;

use Closure;

class CheckIpMiddleware
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
        if (in_array($request->getClientIp(), ['182.61.34.107'])) {
            return $next($request);
        }
        return response(json_encode(array(
            'Code' => 503,
            'Msg' => 'Error!'
        )), 503);
    }
}
