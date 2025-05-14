<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function status()
    {
        $all_applicants = Applicant::with('user', 'job')
            ->whereNotNull('user_id')
            ->whereNotNull('first_name')
            ->whereNotNull('last_name')
            ->whereNotNull('job_id')
            ->orderBy('updated_at', 'desc')
            ->paginate(7);
        
        /** @var \App\Models\User $user */
        $user_id = Auth::id();

        $all_applicants = Applicant::where('user_id', $user_id)->get();

        return view('pages.applicants', [
            'title' => 'Application Status',
            'all_applicants' => $all_applicants
        ]);
    }

    public function applicants()
    {
        $all_applicants = Applicant::with('user', 'job')
            ->whereNotNull('user_id')
            ->whereNotNull('first_name')
            ->whereNotNull('last_name')
            ->whereNotNull('job_id')
            ->orderBy('updated_at', 'desc')
            ->paginate(7);
        
        return view('pages.applicants', [
            'title' => 'Applicants',
            'all_applicants' => $all_applicants
        ]);
    }

    public function hire(Request $request)
    {
        $exists = Employee::where('user_id')
                    ->where('employment_status', 'HIRED')
                    ->exists();
        
        if ($exists)
        {
            return redirect()->route('show.applicants')->with('message', 'Already HIRED.');
        }

        Employee::create([
            'user_id' => $request->input('user_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'applicant_id' => $request->input('applicant_id'),
            'job_id' => $request->input('job_id'),
            'job_title' => $request->input('job_title'),
            'job_role' => $request->input('job_role'),
            'employment_status' => 'HIRED'
        ]);

        Applicant::where('id', $request->input('applicant_id'))->update([
            'application_status' => 'ACCEPTED'
        ]);
    
        return redirect()->route('show.applicants')->with('message', 'Hiring successful!');
    }

    public function deny(Request $request)
    {
        Applicant::where('id', $request->input('applicant_id'))->update([
            'application_status' => 'DENIED'
        ]);
    
        return redirect()->route('show.applicants')->with('message', 'Application DENIED.');
    }
}
