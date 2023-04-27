<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthConstituentCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedConstituent') && ($request->path() != 'constituent/login'))
        {
            return redirect()->route('constituent.login')->with('error', 'You must be logged in');
        }
        if(session()->has('LoggedConstituent') && ($request->path() == 'constituent/login'))
        {
            return back();
        }
        return $next($request)->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}
