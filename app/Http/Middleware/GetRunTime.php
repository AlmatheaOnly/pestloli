<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class GetRunTime
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        return $next($request);

    }

    public function terminate($request, $response)
    {
        //DB::table('run_times')->insert(['url'=>$request->fullUrl(),'time'=>microtime(true)-LARAVEL_START]);
    }
}
