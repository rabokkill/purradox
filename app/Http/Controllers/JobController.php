<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employee;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function job_listings()
    {
        $jobs = Job::orderBy('updated_at', 'desc')->paginate(5);
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

        return redirect()->route('show.jobs')->with('message', 'Job Listing posted successfully!');
    }

    public function update_job (Job $job, Request $request) 
    {
        $validated = $request->validate([
            'job_salary' => 'required|string|max:255',
            'job_desc' => 'nullable|string|max:255',
            'job_slots' => 'required|integer|min:1'
        ]);
        
        $job->update($validated);

        return redirect()->route('show.jobs')->with('message', 'Job Listing updated successfully!');
    }

    public function delete_job (Job $job)
    {
        $job->delete();

        return redirect()->route('show.jobs')->with('message', 'Job Listing deleted successfully!');
    }

    public function apply_job(Request $request)
    {
        $user = Auth::user();
        
        $check = Employee::where('user_id', $user->id)
                    ->where('employment_status', 'HIRED')
                    ->exists();
        
        if ($check)
        {
            return redirect()->route('show.jobs')->with('message', 'You are currently Hired and cannot apply to another job as of the moment.');
        }

        $exists = Applicant::where('user_id', $user->id)
                    ->where('application_status', 'PENDING')
                    ->exists();
        
        if ($exists)
        {
            return redirect()->route('show.jobs')->with('message', 'You currently have a PENDING application. You cannot sumbit multiple applications at once.');
        }

        $job = Job::find($request->input('job_id'));

        Applicant::create([
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'job_id'     => $job->id,
            'job_title'  => $job->job_title,
            'job_role'   => $job->job_role,
        ]);

        $job->decrement('job_slots');
    
        return redirect()->route('show.applicantStatus')->with('message', 'Application Submitted Successfully!');
    }
}