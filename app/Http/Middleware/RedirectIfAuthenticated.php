<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
        case 'gamer':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('home.index');
          }
        if (Auth::guard($guard)->check()) {
        $roles=(auth()->user()->roles->pluck('name'));
            foreach ($roles as  $role) {
                switch ($role) {
                case 'User':
              return  redirect()->route('news');   
         }
       }
     }
        default:
          if (Auth::guard($guard)->check()) {
              return redirect('dashboard');
          }
          break;
      }
      return $next($request);
    }
}
