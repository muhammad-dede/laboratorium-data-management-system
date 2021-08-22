<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MenuPetugas
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
        if (auth()->user()->role == 'siswa') {
            return abort('404');
        } elseif (auth()->user()->role == 'guru') {
            return abort('404');
        }
        return $next($request);
    }
}
