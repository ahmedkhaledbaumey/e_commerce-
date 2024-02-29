<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChangeLang
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has("lang") && session()->get("lang") == "ar") {
            App::setLocale("ar");
        } else {
            App::setLocale("en");
        }

        return $next($request);
    }
}
