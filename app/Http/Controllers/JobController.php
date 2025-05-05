<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function job_listings()
    {
        $jobs = Job::all();
        return view('pages.jobs', [
            'title' => 'Job Listings',
            'all_jobs' => $jobs
        ]);
    }
    
    public function create_job (Request $request) 
    {
        $validated = $request->validate([
            'job_dept' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_role' => 'required|string|max:255',
            'job_salary' => 'required|string|max:255',
            'job_desc' => 'nullable|string|max:255',
            'job_slots' => 'required|integer|min:1'
        ]);
        
        $newJob = Job::create($validated);

        return redirect()->route('show.jobs');
    }
}
