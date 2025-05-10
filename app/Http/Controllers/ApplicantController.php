<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function applicants()
    {
        $applicants = Applicant::with('user', 'job')
            ->whereNotNull('user_id')
            ->whereNotNull('job_id')
            ->orderBy('updated_at', 'desc')
            ->paginate(7);

        return view('pages.applicants', [
            'title' => 'Applicants',
            'all_applicants' => $applicants
        ]);
    }
}
