<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle()
    {
        if (Auth::user() &&  Auth::user()->is_admin == 1) {
            return redirect('/dashboard-admin');
        }

        return redirect('/dashboard-user');
    }
}