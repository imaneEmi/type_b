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
    public function handle(Request $request)
    {
        $user = $request->user();
        if ($user != null && $user->hasRole('admin')) {
            return redirect('/dashboard-admin');
        }
        return redirect('/dashboard-user');
    }
}
