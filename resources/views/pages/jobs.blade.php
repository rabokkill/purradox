@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    <h1 class="page-title">{{ $title }}</h1>
    <!-- New Job Listing -->
    <button class="btn btn-job" type="button" data-bs-toggle="modal" data-bs-target="#newJobListing">New Job Listing</button>
    <br>
    <form method="POST" action="{{ route('create.job') }}">
        @csrf
        <div class="modal fade" id="newJobListing" tabindex="-1" aria-labelledby="newJobListingLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newJobListingLabel">New Job Listing</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="select_dept">Department</label>
                             <select id="select_dept" name="job_dept" class="form-select" aria-label="Department select" required>
                                <option selected>Departments</option>
                                <option value="Game Design">Game Design</option>
                                <option value="Art and Animation">Art and Animation</option>
                                <option value="Quality Assurance">Quality Assurance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select_title">Title</label>
                             <select id="select_title" name="job_title" class="form-select" aria-label="Title select" required>
                                <option selected disabled>- choose Department first -</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select_role">Role</label>
                             <select id="select_role" name="job_role" class="form-select" aria-label="Role select" required>
                                <option selected>Roles</option>
                                <option value="Junior">Junior</option>
                                <option value="Senior">Senior</option>
                                <option value="Lead">Lead</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select_salary">Salary in PHP</label>
                            <input type="text" id="select_salary" name="job_salary" class="form-control" placeholder="- choose Role first -" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="job_desc">Description</label>
                            <textarea id="job_desc" name="job_desc" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="job_slots">Slots</label>
                            <input type="number" name="job_slots" class="form-control" id="job_slots" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Show All Jobs -->
    <div class="data-list">
        <table class="content-table">
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
                    <th>Salary (PHP)</th>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($all_jobs as $job)
                    @auth
                        @php $isNotAdmin = auth()->user()->isNotAdmin(); @endphp
                    @endauth
                    @auth
                        @if($isNotAdmin && $job->job_slots <= 0)
                            @continue
                        @endif
                    @endauth
                    <tr id="view-mode-{{ $job->id }}" class="view-mode">
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        @auth
                            @if(auth()->user()->isAdmin())
                            <td class="text-center">{{ $job->id }}</td>
                            @endif
                        @endauth
                        <td>{{ $job->job_dept }}</td>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->job_role }} {{ $job->job_title }}</td>
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
                                    <form id="delete-form-{{ $job->id }}" method="POST" action="{{ route('delete.job', ['job' => $job]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-bs-target="#messageModal" 
                                            data-form-id="delete-form-{{ $job->id }}" data-bs-toggle="modal" 
                                            data-message="Are you sure you want to delete this Job Listing?"><i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            @else
                                <!-- Apply Button -->
                                <td class="text-center">
                                    <form id="apply-form-{{ $job->id }}" method="POST" action="{{ route('apply.job') }}">
                                        @csrf
                                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                                        <button type="button" class="btn btn-success" data-bs-target="#messageModal" 
                                            data-form-id="apply-form-{{ $job->id }}" data-bs-toggle="modal" 
                                            data-message="Submit your application?"><i class="bi bi-hand-index-thumb-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        @endauth
                    </tr>
                    <tr id="edit-mode-{{ $job->id }}" class="toggle-form">
                        <td class="text-center">{{ $job->id }}</td>
                        <td>{{ $job->job_dept }}</td>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->job_role }} {{ $job->job_title }}</td>
                        <td>
                            <form method="POST" action="{{ route('update.job', ['job' => $job]) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="job_salary" value="{{ $job->job_salary }}" class="form-control">
                        </td>
                        <td><input type="text" name="job_desc" value="{{ $job->job_desc }}" class="form-control"></td>
                        <td><input type="number" name="job_slots" value="{{ $job->job_slots }}" class="form-control text-center"></td>
                        <td class="text-center">{{ $job->created_at }}</td>
                        <td class="text-center">{{ $job->updated_at }}</td>
                        <!-- Update Button -->
                        <td class="text-center">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-square-fill"></i></button>
                            </form> <!-- Close the form here -->
                        </td>
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
</div>
@include('layouts.message')
<script>
    // New Job Listing
    const departmentSelect = document.getElementById('select_dept');
    const titleSelect = document.getElementById('select_title');
    const roleSelect = document.getElementById('select_role');
    const salaryAuto = document.getElementById('select_salary');

    const titlesByDepartment = {
        "Game Design": ["Game Designer","Level Designer", "Narrative Designer", "Systems Designer", "UX Designer"],
        "Art and Animation": ["Concept Artist", "3D Modeler", "Texture Artist", "Animator", "VFX Artist", "UI Artist", "Technical Artist"],
        "Quality Assurance": ["QA Tester", "QA Analyst", "Playtester"]
    };

    departmentSelect.addEventListener('change', function () {
        const selectedDept = this.value;
        titleSelect.innerHTML = '<option selected disabled>Titles</option>';

        if (titlesByDepartment[selectedDept]) {
            titlesByDepartment[selectedDept].forEach(title => {
                const option = document.createElement('option');
                option.value = title;
                option.textContent = title;
                titleSelect.appendChild(option);
            });
        }
    });

    const salariesByRole = {
        "Junior": ["20,000-35,000"],
        "Senior": ["35,000-50,000"],
        "Lead": ["50,000-80,000"]
    };

    roleSelect.addEventListener('change', function () {
        const selectedRole = this.value;

        if (salariesByRole[selectedRole]) {
            salaryAuto.value = salariesByRole[selectedRole][0];
            salaryAuto.disabled = false;
        } else {
            salaryAuto.value = '';
            salaryAuto.disabled = true;
        }
    });

    // Update Job Listing
    function toggleMode(jobID) {
        var editMode = document.getElementById('edit-mode-' + jobID);
        var viewMode = document.getElementById('view-mode-' + jobID);

        var isEditing = editMode.style.display === "table-row";

        editMode.style.display = isEditing ? "none" : "table-row";
        viewMode.style.display = isEditing ? "table-row" : "none";
    }
</script>
@endsection