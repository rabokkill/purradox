<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function authenticated()
    {
        return view('pages.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    public function job_listings()
    {
        $jobs = Job::all();
        return view('pages.jobs', [
            'title' => 'Job Listings',
            'all_jobs' => $jobs
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
