<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function authenticated()
    {
        return view('pages.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    // public function admin()
    // {
    //     return view('admin.dashboard');
    // }

    // public function user()
    // {
    //     return view('user.dashboard');
    // }
}
