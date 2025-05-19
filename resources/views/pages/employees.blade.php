@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    <h1 class="page-title">{{ $title }}</h1>
    @auth
        @if(auth()->user()->isAdmin())
            <div class="status-box">
                @if ($all_employees->isNotEmpty())
                    <div class="data-list">
                        <table class="content-table">
                            <thead>
                                <tr class="active">
                                    <th>Employee Name</th>
                                    <th>Job</th>
                                    <th>Status</th>
                                    <th>Date Hired</th>
                                    <th>Review</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_employees as $employee)
                                    <tr class="text-center">
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->job_title }} - {{ $employee->job_role }}</td>
                                        <td>{{ $employee->employment_status }}</td>
                                        <td>{{ $employee->created_at }}</td>
                                        @if ($employee->employment_status === 'HIRED')
                                            <td class="text-center">
                                                <!-- Dismiss Button -->
                                                <form id="dismiss-form-{{ $employee->id }}" method="POST" action="{{ route('dismiss.employees') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                                    <button type="button" class="btn btn-danger" data-bs-target="#messageModal" 
                                                        data-form-id="dismiss-form-{{ $employee->id }}" data-bs-toggle="modal" 
                                                        data-message="Are you sure you want to DISMISS this employee?"><i class="bi bi-person-x danger"> Dismiss</i>
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td><i class="bi bi-calendar-x"></i> {{ $employee->updated_at }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h3 class='second-header text-center'>No Employees yet.</h3>
                @endif
            </div>
        @else
            <div class="status-box">
                @if ($all_employees->isNotEmpty())
                <h3 class="second-header" style="margin-bottom: 12px;">Employee Name: {{ Auth::user()->full_name }}</h3>
                <table class="content-table">
                    <thead>
                        <tr class="active">
                            <th>Employment Date</th>
                            <th>Job</th>
                            <th>Status</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_employees as $employee)
                            <tr class="text-center">
                                <td>{{ $employee->created_at }}</td>
                                <td>{{ $employee->job_title }}</td>
                                <td>{{ $employee->employment_status }}</td>
                                @if ($employee->employment_status === 'HIRED')
                                    <td>
                                        <!-- Resign Button -->
                                        <form id="resign-form-{{ $employee->id }}" method="POST" action="{{ route('resign.employees') }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                            <button type="button" class="btn btn-danger" data-bs-target="#messageModal" 
                                                data-form-id="resign-form-{{ $employee->id }}" data-bs-toggle="modal" 
                                                data-message="Are you sure you want to Resign?"><i class="bi bi-file-earmark-excel"> Resign</i>
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    <td><i class="bi bi-calendar-x"></i> {{ $employee->updated_at }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3 class='second-header text-center'>You have not been Hired yet.</h3>
                @endif
            </div>
        @endif
    @endauth
</div>
@include('layouts.message')
@endsection