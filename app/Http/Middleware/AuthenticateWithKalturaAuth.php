<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateWithKalturaAuth
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
        if (!session('ks')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
