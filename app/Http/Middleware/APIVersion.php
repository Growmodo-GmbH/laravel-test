<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class APIVersion
{
    public function handle(Request $request, Closure $next, $guard): Response
    {
        config(['app.api.version' => $guard]);
        
        return $next($request);
    }
}
