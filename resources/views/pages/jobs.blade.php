@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    <h1>{{ $title }}</h1>
    <!-- New Job Listing -->
    <button class="btn btn-secondary btn-jobs" type="button" data-bs-toggle="modal" data-bs-target="#newJobListing">New Job Listing</button>
    <form method="POST" action="{{ route('create.job') }}">
        @csrf
        <div class="modal fade" id="newJobListing" tabindex="-1" aria-labelledby="newJobListing" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Job Listing</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="job_dept">Department</label>
                            <input type="text" name="job_dept" class="form-control" id="job_dept" required>
                        </div>
                        <div class="form-group">
                            <label for="job_title">Title</label>
                            <input type="text" name="job_title" class="form-control" id="job_title" required>
                        </div>
                        <div class="form-group">
                            <label for="job_role">Role</label>
                            <input type="text" name="job_role" class="form-control" id="job_role" required>
                        </div>
                        <div class="form-group">
                            <label for="job_salary">Salary</label>
                            <input type="text" name="job_salary" class="form-control" id="job_salary" required>
                        </div>
                        <div class="form-group">
                            <label for="job_desc">Description</label>
                            <textarea name="job_desc" id="job_desc" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="job_slots">Slots</label>
                            <input type="number" name="job_slots" class="form-control" id="job_slots" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Show All Jobs -->
    <div class="data-list">
        <table class="table table-bordered">
            <thead>
                <tr class="active">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <th>ID</th>
                        @endif
                    @endauth
                    <th>Department</th>
                    <th>Title</th>
                    <th>Role</th>
                    <th>Salary</th>
                    <th>Description</th>
                    <th>Slots</th>
                    <th>Date Posted</th>
                    <th>Last Updated</th>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <th>UPDATE</th>
                            <th>DELETE</th>
                        @else
                            <th>APPLY</th>
                        @endif
                    @endauth
                    <!-- <th id="toggleEdit('view-mode')">DELETE</th>
                    <th id="toggleEdit('edit-mode')">CANCEL</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($all_jobs as $job)
                    <tr id="view-mode-{{ $job->id }}" class="view-mode">
                        @auth
                            @if(auth()->user()->isAdmin())
                            <td class="text-center">{{ $job->id }}</td>
                            @endif
                        @endauth
                        <td>{{ $job->job_dept }}</td>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->job_role }}</td>
                        <td>{{ $job->job_salary }}</td>
                        <td>{{ $job->job_desc }}</td>
                        <td class="text-center">{{ $job->job_slots }}</td>
                        <td class="text-center">{{ $job->created_at }}</td>
                        <td class="text-center">{{ $job->updated_at }}</td>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <!-- Update Button -->
                                <td class="text-center">
                                    <button class="btn btn-success" type="button" 
                                        onclick="toggleMode('{{ $job->id }}')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                                <!-- Delete Button -->
                                <td class="text-center">
                                    <form method="POST" action="{{ route('delete.job', ['job' => $job]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-bs-target="#messageModal" data-bs-toggle="modal"><i class="bi bi-trash3-fill"></i></button>
                                        <?php $message = 'Are you sure you want to delete this Job Listing?'?>
                                        @include('layouts.message')
                                    </form>
                                </td>
                            @else
                                <!-- Apply Button -->
                                <td class="text-center">
                                    <form method="POST" action="{{ route('apply.job') }}">
                                        @csrf
                                        @method('POST')
                                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                                            <input type="hidden" name="job_title" value="{{ $job->job_title }}">
                                            <input type="hidden" name="job_role" value="{{ $job->job_role }}">
                                            <button type="button" class="btn btn-success" data-bs-target="#messageModal" data-bs-toggle="modal"><i class="bi bi-hand-index-thumb-fill"></i></button>
                                            <?php $message = 'Submit your application?'?>
                                            @include('layouts.message')
                                    </form>
                                </td>
                            @endif
                        @endauth
                    </tr>
                    <tr id="edit-mode-{{ $job->id }}" class="toggle-form">
                        <td class="text-center">{{ $job->id }}</td>
                        <form method="POST" action="{{ route('update.job', ['job' => $job]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="job_id" value="{{ $job->id }}"/>
                            <td><input type="text" name="job_dept" value="{{ $job->job_dept }}" class="form-control"/></td>
                            <td><input type="text" name="job_title" value="{{ $job->job_title }}" class="form-control"/></td>
                            <td><input type="text" name="job_role" value="{{ $job->job_role }}" class="form-control"/></td>
                            <td><input type="text" name="job_salary" value="{{ $job->job_salary }}" class="form-control"/></td>
                            <td><input type="text" name="job_desc" value="{{ $job->job_desc }}" class="form-control"/></td>
                            <td><input type="number" name="job_slots" value="{{ $job->job_slots }}" class="form-control text-center"/></td>
                            <td class="text-center">{{ $job->created_at }}</td>
                            <td class="text-center">{{ $job->updated_at }}</td>
                            <!-- Update Button -->
                            <td class="text-center">
                                <button type="submit" class="btn btn-success"><i class="bi bi-check-square-fill"></i></button>
                            </td>
                        </form>
                        <!-- Cancel Update Button -->
                        <td class="text-center">
                            <button class="btn btn-warning" type="button" 
                                onclick="toggleMode('{{ $job->id }}')">
                                <i class="bi bi-arrow-return-left"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <!-- Pages -->
    <div class="pages justify-content-between">
        {{ $all_jobs->links('pagination::bootstrap-5') }}
    </div>
    <!-- Success Modal -->
    @if(session()->has('message'))
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="feedbackModalLabel">Notice</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <p>{{ session('message') }}</p>
        </div>
        </div>
    </div>
    </div>
    @endif
    <!-- Error Modal -->
    @if ($errors->any())
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="feedbackModalLabel">Error</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            </ul>
        </div>
        </div>
    </div>
    </div>
    @endif
</div>
@endsection