<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function job_listings()
    {
        $jobs = Job::orderBy('created_at', 'desc')->paginate(7);
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

        $exists = Job::where('job_title', $validated['job_title'])
                    ->where('job_role', $validated['job_role'])
                    ->exists();
        
        if ($exists)
        {
            return back()->withErrors([
                'job_title' => 'Combination of Job Title & Role already exists! Please try again.'
            ])->withInput();
        }
        
        Job::create($validated);

        return redirect()->route('show.jobs')->with('success', 'Job Listing Added Successfully!');
    }

    public function update_job (Job $job, Request $request) 
    {
        $validated = $request->validate([
            'job_dept' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_role' => 'required|string|max:255',
            'job_salary' => 'required|string|max:255',
            'job_desc' => 'nullable|string|max:255',
            'job_slots' => 'required|integer|min:1'
        ]);
        
        $job->update($validated);

        return redirect()->route('show.jobs')->with('success', 'Job Listing Updated Successfully!');
    }

    public function delete_job (Job $job)
    {
        $job->delete();

        return redirect()->route('show.jobs')->with('success', 'Job Listing Deleted Successfully!');
    }
}
