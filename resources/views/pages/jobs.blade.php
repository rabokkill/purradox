@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    <h1>{{ $title }}</h1>
    <button class="btn btn-secondary btn-jobs" type="button" onclick="toggleActionField('addAction')">Add Job Listing</button>
    <div id="addAction" class="toggle-form">
        <form class="job-panel" method="POST" action="{{ route('create.job') }}">
            @csrf
            <input type="hidden" name="action" value="add">
            <button type="button" class="btn-x" onclick="toggleActionField('closeForm')"><i class="bi bi-x-lg"></i></button>
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
                <!-- <input type="text" name="job_desc" class="form-control" id="job_desc"> -->
            </div>
            <div class="form-group">
                <label for="job_slots">Slots</label>
                <input type="number" name="job_slots" class="form-control" id="job_slots" required>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    <div class="data-list">
        <table class="table table-bordered">
            <thead>
                <tr class="active">
                    <th>ID</th>
                    <th>Department</th>
                    <th>Title</th>
                    <th>Role</th>
                    <th>Salary</th>
                    <th>Description</th>
                    <th>Slots</th>
                    <th>Date Posted</th>
                    <th>Last Updated</th>
                    <th>UPDATE</th>
                    <th>CANCEL</th>
                    <!-- <th id="toggleEdit('view-mode')">DELETE</th>
                    <th id="toggleEdit('edit-mode')">CANCEL</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($all_jobs as $job)
                    <tr id="view-mode-{{ $job->id }}" class="view-mode">
                        <td class="text-center">{{ $job->id }}</td>
                        <td>{{ $job->job_dept }}</td>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->job_role }}</td>
                        <td>{{ $job->job_salary }}</td>
                        <td>{{ $job->job_desc }}</td>
                        <td class="text-center">{{ $job->job_slots }}</td>
                        <td class="text-center">{{ $job->created_at }}</td>
                        <td class="text-center">{{ $job->updated_at }}</td> 
                        <!-- Update Button -->
                        <td class="success text-center">
                            <button class="btn btn-success" type="button" 
                                onclick="toggleMode('{{ $job->id }}')">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                        <!-- Update Button End -->
                        <!-- Delete Button -->
                        <td class="danger text-center">
                            <form method="POST" action="{{ route('delete.job', ['job' => $job]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" name="action" value="delete" 
                                    onclick="return confirm('Are you sure you want to DELETE this Job Listing?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                        <!-- Delete Button End -->
                    </tr>
                    <tr id="edit-mode-{{ $job->id }}" class="toggle-form">
                        <td class="text-center">{{ $job->id }}</td>
                        <form method="POST" action="{{ route('update.job', ['job' => $job]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="jobID" value="{{ $job->id }}"/>
                            <td><input type="text" name="job_dept" value="{{ $job->job_dept }}" class="form-control"/></td>
                            <td><input type="text" name="job_title" value="{{ $job->job_title }}" class="form-control"/></td>
                            <td><input type="text" name="job_role" value="{{ $job->job_role }}" class="form-control"/></td>
                            <td><input type="text" name="job_salary" value="{{ $job->job_salary }}" class="form-control"/></td>
                            <td><input type="text" name="job_desc" value="{{ $job->job_desc }}" class="form-control"/></td>
                            <td><input type="number" name="job_slots" value="{{ $job->job_slots }}" class="form-control text-center"/></td>
                            <td class="text-center">{{ $job->created_at }}</td>
                            <td class="text-center">{{ $job->updated_at }}</td>
                            <!-- Update Button -->
                            <td class="success text-center">
                                <!-- <button class="btn btn-success" type="submit" name="action" value="update"
                                    onclick="return confirm('Submit UPDATE?')">
                                    <i class="bi bi-check-square-fill"></i>
                                </button> -->

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="bi bi-check-square-fill"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Submit UPDATE?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                        </form>
                        <!-- Update Button End -->
                        <!-- Cancel Update Button -->
                        <td class="warning text-center">
                            <button class="btn btn-warning" type="button" 
                                onclick="toggleMode('{{ $job->id }}')">
                                <i class="bi bi-arrow-return-left"></i>
                            </button>
                        </td>
                        <!-- Cancel Update Button End -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>{{ $all_jobs->links() }}
    @if(session()->has('success'))
        <h4>- {{ session('success') }} -</h4>
    @endif
    <!-- Success End -->
    <!-- Error -->
    @if ($errors->any())
    <div class="alert alert-danger" style="margin-top:10px">
        @foreach ($errors->all() as $error)
            <div class="text-center">{{ $error }}</div>
        @endforeach
    </div>
    @endif
    <!-- Error End-->
</div>
@endsection