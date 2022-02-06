<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user != null && $user->hasRole('admin')) {
            return redirect('/dashboard-admin');
        }
        return redirect('/dashboard-user');
    }
}
