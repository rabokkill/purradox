<div class="col-2 sidebar">
    <img src="{{url('assets/Purradox-Logo.png')}}" style="width:75%;">
    <nav class="nav nav-pills flex-column">
        <h6><i class="bi bi-person-circle"></i> {{ Auth::user()->username }}</h6>
        <a class="nav-link text-center" href="{{ route('dashboard') }}" 
            style="color:white; background-color:black;">
            <i class="bi bi-house-door-fill"></i>
        </a>
        <a class="nav-link {{ Route::currentRouteNamed('show.jobs') ? 'active' : '' }}" href="{{ route('show.jobs') }}">Job Listings</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a class="nav-link {{ Route::currentRouteNamed('show.employees') ? 'active' : '' }}" href="{{ route('show.employees') }}">Employees</a>
                <a class="nav-link {{ Route::currentRouteNamed('show.applicants') ? 'active' : '' }}" href="{{ route('show.applicants') }}">Applicants</a>
            @else
                <a class="nav-link {{ Route::currentRouteNamed('show.employeeStatus') ? 'active' : '' }}" href="{{ route('show.employeeStatus') }}">Employment Status</a>
                <a class="nav-link {{ Route::currentRouteNamed('show.applicantStatus') ? 'active' : '' }}" href="{{ route('show.applicantStatus') }}">Application Status</a>
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