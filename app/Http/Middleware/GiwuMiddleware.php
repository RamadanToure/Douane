<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use App\Providers\GiwuService;

class GiwuMiddleware
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
        GiwuService::BrowserControl();
        ///Application en cours de maintenance
        // if(trans('data.maintenance') == "oui"){
        //     return Redirect::to('webmaint');
        // }
        return $next($request);
    }
}
