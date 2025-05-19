@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    <h1 class="page-title">{{ $title }}</h1>
    @auth
        @if(auth()->user()->isAdmin())
            <div class="status-box">
                @if ($all_applicants->isNotEmpty())
                    <div class="data-list">
                        <table class="content-table">
                            <thead>
                                <tr class="active">
                                    <th>Applicant Name</th>
                                    <th>Applied Job</th>
                                    <th>Status</th>
                                    <th>Application Date</th>
                                    <th>Review</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_applicants as $applicant)
                                    <tr class="text-center">
                                        <td>{{ $applicant->full_name }}</td>
                                        <td>{{ $applicant->job_title }} - {{ $applicant->job_role }}</td>
                                        <td>{{ $applicant->application_status }}</td>
                                        <td>{{ $applicant->created_at }}</td>
                                        @if ($applicant->application_status === 'PENDING')
                                            <td class="text-center" style="display: flex; justify-content: space-evenly; width: 100%;">
                                                <!-- Hire Button -->
                                                <div>
                                                    <form id="hire-form-{{ $applicant->id }}" method="POST" action="{{ route('hire.applicants') }}">
                                                        @csrf
                                                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                                                        <button type="button" class="btn btn-success" data-bs-target="#messageModal" 
                                                            data-form-id="hire-form-{{ $applicant->id }}" data-bs-toggle="modal"
                                                            data-message="Continue with HIRING this applicant?"><i class="bi bi-hand-thumbs-up-fill"> Accept</i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <!-- Deny Button -->
                                                <div>
                                                    <form id="deny-form-{{ $applicant->id }}" method="POST" action="{{ route('deny.applicants') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                                                        <button type="button" class="btn btn-danger" data-bs-target="#messageModal" 
                                                            data-form-id="deny-form-{{ $applicant->id }}" data-bs-toggle="modal" 
                                                            data-message="Are you sure you want to DENY this application?"><i class="bi bi-hand-thumbs-down-fill"> Deny</i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @elseif ($applicant->application_status === 'ACCEPTED')
                                            <td><i class="bi bi-calendar-check"></i> {{ $applicant->updated_at }}</td>
                                        @elseif ($applicant->application_status === 'DENIED')
                                            <td><i class="bi bi-calendar-x"></i> {{ $applicant->updated_at }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h3 class='second-header text-center'>No Applicants yet.</h3>
                @endif
            </div>
        @else
            <div class="status-box">
                @if ($all_applicants->isNotEmpty())
                <h3 class="second-header" style="margin-bottom: 12px;">Applicant Name: {{ Auth::user()->full_name }}</h3>
                <table class="content-table">
                    <thead>
                        <tr class="active">
                            <th>Application Date</th>
                            <th>Applied Job</th>
                            <th>Status</th>
                            <th>Date Reviewed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_applicants as $applicant)
                            <tr class="text-center">
                                <td>{{ $applicant->created_at }}</td>
                                <td>{{ $applicant->job_role }} {{ $applicant->job_title }}</td>
                                <td>{{ $applicant->application_status }}</td>
                                @if ($applicant->application_status === 'ACCEPTED')
                                    <td><i class="bi bi-calendar-check"></i> {{ $applicant->updated_at}}</td>
                                @elseif ($applicant->application_status === 'DENIED')
                                    <td><i class="bi bi-calendar-x"></i> {{ $applicant->updated_at }}</td>
                                @else
                                    <td>Still up for review.</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3 class='second-header text-center'>You have not submitted any Application yet.</h3>
                @endif
            </div>
        @endif
    @endauth
</div>
@include('layouts.message')
@endsection