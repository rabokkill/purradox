<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function status()
    {
        $all_employees = Employee::with('user', 'job', 'applicant')
            ->whereNotNull('user_id')
            ->whereNotNull('first_name')
            ->whereNotNull('last_name')
            ->whereNotNull('applicant_id')
            ->whereNotNull('job_id')
            ->orderBy('updated_at', 'desc')
            ->paginate(7);
        
        /** @var \App\Models\User $user */
        $user_id = Auth::id();

        $all_employees = Employee::where('user_id', $user_id)->get();

        return view('pages.employees', [
            'title' => 'Employment Status',
            'all_employees' => $all_employees
        ]);
    }

    public function employees()
    {
        $all_employees = Employee::with('user', 'job', 'applicant')
            ->whereNotNull('user_id')
            ->whereNotNull('first_name')
            ->whereNotNull('last_name')
            ->whereNotNull('applicant_id')
            ->whereNotNull('job_id')
            ->orderBy('updated_at', 'desc')
            ->paginate(7);
        return view('pages.employees', [
            'title' => 'Employees',
            'all_employees' => $all_employees
        ]);
    }

    public function dismiss(Request $request)
    {
        Employee::where('id', $request->input('employee_id'))->update([
            'employment_status' => 'DISMISSED'
        ]);
    
        return redirect()->route('show.employees')->with('message', 'Employee DISMISSED.');
    }

    public function resign(Request $request)
    {
        Employee::where('id', $request->input('employee_id'))->update([
            'employment_status' => 'RESIGNED'
        ]);
    
        return redirect()->route('show.employeeStatus')->with('message', 'RESIGNED successfully.');
    }
}
