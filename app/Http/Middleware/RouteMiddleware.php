<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $original = $next($request)->original;

        if($request->ajax() && $request->hasHeader('X-VIEW') && $original instanceof \Illuminate\View\View)
            return response($original);

        if($next($request)->isOk())
            return response()->view('main',['content' => $original]);
        else
            return $next($request);
    }
}