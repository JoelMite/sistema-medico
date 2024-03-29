<?php

namespace App\Http\Middleware;

use Closure;

class PatientMiddleware
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
      if (auth()->user()->roles()->first()->name == 'Paciente') {
        return $next($request);
      }

      return redirect('/');
    }
}
