<div class="col-sm-2 sidebar">
    <img src="{{url('assets/NekoBytesLogo.png')}}" style="width:80%;">
    <ul class="nav nav-pills nav-stacked">
        <li><h6><i class="bi bi-person-circle"></i> {{ Auth::user()->username }}</h6></li>
        <li class="active text-center"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a></li>
        <li><a href="{{ route('show.jobs') }}">Job Listings</a></li>
        @auth
            @if(auth()->user()->user_type === 'admin')
                <li><a href="">Employees</a></li>
                <li><a href="">Applicants</a></li>
            @else
                <li><a href="">Employment Status</a></li>
                <li><a href="">Application Status</a></li>
            @endif
        @endauth
    </ul>
    <div id="today"></div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout" style="border: none; background: none;">
            <i class="bi bi-box-arrow-left"></i> Logout
        </button>
    </form>
</div>