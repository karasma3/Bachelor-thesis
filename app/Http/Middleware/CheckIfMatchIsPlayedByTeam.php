<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;

class CheckIfMatchIsPlayedByTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $match = $request->route('match');
        if(Auth::check() and (Auth::user()->participant($match) or Auth::user()->isAdmin())){

        }
        return $next($request);
    }
}
