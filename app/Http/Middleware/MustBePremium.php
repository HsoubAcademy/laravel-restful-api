<?php

namespace App\Http\Middleware;

use Closure;

class MustBePremium
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
        if( $request->user() && $request->user()->isPremium() )
        {
            return $next($request);
        }
        return redirect('/home');
    }
}
