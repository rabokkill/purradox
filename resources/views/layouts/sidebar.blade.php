<div class="col-2 sidebar">
    <img src="{{url('assets/Purradox-Logo.png')}}" style="width:75%;">
    <nav class="nav nav-pills flex-column">
        <h6><i class="bi bi-person-circle"></i> {{ Auth::user()->username }}</h6>
        <a class="nav-link active text-center" aria-current="page" href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
        <a class="nav-link" href="{{ route('show.jobs') }}">Job Listings</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a class="nav-link" href="{{ route('show.employees') }}">Employees</a>
                <a class="nav-link" href="{{ route('show.applicants') }}">Applicants</a>
            @else
                <a class="nav-link" href="{{ route('show.employeeStatus') }}">Employment Status</a>
                <a class="nav-link" href="{{ route('show.applicantStatus') }}">Application Status</a>
            @endif
        @endauth
    </nav>
    <div id="today"></div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout" style="border: none; background: none;">
            <i class="bi bi-box-arrow-left"></i> Logout
        </button>
    </form>
</div>