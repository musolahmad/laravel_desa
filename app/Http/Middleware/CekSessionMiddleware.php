<?php

namespace App\Http\Middleware;

use Closure;

class CekSessionMiddleware
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
        if (!session('berhasil_login')) {
            # code...
            return redirect(url('/'));
        }
        return $next($request);
    }
}
