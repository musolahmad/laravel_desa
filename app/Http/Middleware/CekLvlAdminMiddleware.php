<?php

namespace App\Http\Middleware;

use Closure;

class CekLvlAdminMiddleware
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
        if (session('lvl_admin')=='2') {
            # code...
            return redirect(url('/'));
        }
        return $next($request);
    }
}
