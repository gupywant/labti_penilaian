<?php

namespace App\Http\Middleware;

use Closure;

class SessionHasAsisten
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
        if($request->session()->exists('asisten')) {
            return $next($request);
        }else{
            if(session('alert')){
                return redirect('asisten/login')->with('alert','Username atau Password salah!!!');
            }else{
                return redirect('asisten/login')->with('alert','Login Terlebih Dahulu');
            }
        }
    }
}
