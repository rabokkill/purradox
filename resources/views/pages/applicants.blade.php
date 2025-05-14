@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    <h1>{{ $title }}</h1>
    @auth
        @if(auth()->user()->isAdmin())
            <div class="data-list">
                <table class="table table-bordered">
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
                                    <form id="hire-form-{{ $applicant->id }}" method="POST" action="{{ route('hire.applicants') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $applicant->user_id }}">
                                        <input type="hidden" name="first_name" value="{{ $applicant->first_name }}">
                                        <input type="hidden" name="last_name" value="{{ $applicant->last_name }}">
                                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                                        <input type="hidden" name="job_id" value="{{ $applicant->job_id }}">
                                        <input type="hidden" name="job_title" value="{{ $applicant->job_title }}">
                                        <input type="hidden" name="job_role" value="{{ $applicant->job_role }}">
                                        <button type="button" class="btn btn-success" data-bs-target="#messageModal" 
                                            data-form-id="hire-form-{{ $applicant->id }}" data-bs-toggle="modal"
                                            data-message="Continue with hiring this applicant?"><i class="bi bi-hand-thumbs-up-fill"> Accept</i></button>
                                    </form>
                                    <!-- Deny Button -->
                                    <form id="deny-form-{{ $applicant->id }}" method="POST" action="{{ route('deny.applicants') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                                        <button type="button" class="btn btn-danger" data-bs-target="#messageModal" 
                                        data-form-id="deny-form-{{ $applicant->id }}" data-bs-toggle="modal" 
                                        data-message="Are you sure you want to deny this application?"><i class="bi bi-hand-thumbs-down-fill"> Deny</i></button>
                                    </form>
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
            <div class="applicant-status">
                @if ($all_applicants->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                            <th>Application Date</th>
                            <th>Applied Job</th>
                            <th>Status</th>
                            <th>Date Reviewed</th>
                        </tr>
                    </thead>
                    <tbody>
                    <h3>Applicant Name: {{ Auth::user()->full_name }}</h3>
                    
                        @foreach ($all_applicants as $applicant)
                            <tr class="text-center">
                                <td>{{ $applicant->created_at }}</td>
                                <td>{{ $applicant->job_title }}</td>
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
                    <h3 class='text-center'>You have not submitted any Application yet.</h3>
                @endif
            </div>
        @endif
    @endauth
</div>
<!-- Confirm Modal -->
<div class="modal fade" id="messageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Confirm</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalMessage">
            <!-- Message -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" id="confirmAction" class="btn btn-primary">Confirm</button>
        </div>
        </div>
    </div>
</div>
<script>
    let targetFormId = '';

    const messageModal = document.getElementById('messageModal');
    messageModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const message = button.getAttribute('data-message');
        targetFormId = button.getAttribute('data-form-id');

        const modalMessage = messageModal.querySelector('#modalMessage');
        modalMessage.textContent = message;
    });

    document.getElementById('confirmAction').addEventListener('click', function () {
        if (targetFormId) {
            document.getElementById(targetFormId).submit();
        }
    });
</script>
@endsection