<?php

namespace App\Middleware;

use Closure;

class FirstConfiguration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user() ||
            ! $request->user()->hasAnyModules()) {
            return to_route('first-configuration');
        }

        return $next($request);
    }
}
