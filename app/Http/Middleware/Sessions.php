<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Sessions
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
        $this->setRegion($request->route('region'));
        $this->setServer($request->route('server'));
        $this->setCharactername($request->route('charactername'));
        return $next($request);
    }

    private function setRegion($region)
    {
        Session::put('region', $region);
    }

    private function setServer($server)
    {
        Session::put('server', $server);
    }

    private function setCharactername($charactername)
    {
        Session::put('charactername', $charactername);
    }
}
