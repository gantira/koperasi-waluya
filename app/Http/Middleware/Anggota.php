<?php

namespace App\Http\Middleware;

use Closure;

class Anggota
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
        if (auth()->check() && auth()->user()->isAnggota()) {
            return $next($request);
        }

        return redirect('404');
    }
}
