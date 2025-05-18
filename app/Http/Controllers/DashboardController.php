<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employee;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function authenticated()
    {
        $user = Auth::user();

        $latestJob = Job::orderBy('updated_at', 'desc')->first();
        $oldestJob = Job::orderBy('updated_at', 'asc')->first();
        $jobCount = Job::count();
        $hiredCount = Employee::where('employment_status', 'HIRED')->count();
        $pendingCount = Applicant::where('application_status', 'PENDING')->count();
        $availableJobCount = Job::where('job_slots', '>', 0)->count();
        $employmentStatus = Employee::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->value('employment_status');
        $applicationStatus = Applicant::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->value('application_status');

        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'latestJob' => $latestJob,
            'oldestJob' => $oldestJob,
            'jobCount' => $jobCount,
            'hiredCount' => $hiredCount,
            'pendingCount' => $pendingCount,
            'availableJobCount' => $availableJobCount,
            'employmentStatus' => $employmentStatus,
            'applicationStatus' => $applicationStatus
        ]);
    }
}
