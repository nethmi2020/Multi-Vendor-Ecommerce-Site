<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       app()->setLocale(Session::get('language'));
        // $lan=Session::get('language') ?? 'en';
        // app()->setLocale(Session::get($lan));

        if(Session::has('language'))
        {
            app()->setLocale(Session::get('language'));
        }
        else
        {
            app()->setLocale('en');
            $request->session()->put('language', 'en');
        }
        return $next($request);
    }
}
