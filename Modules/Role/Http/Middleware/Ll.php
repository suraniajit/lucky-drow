<?php

namespace Modules\Role\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        echo 44455;die;
        return $next($request);
    }
}
