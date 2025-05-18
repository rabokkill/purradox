@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    @auth
        @if(auth()->user()->isAdmin())
            <h1>Welcome to the Admin Page, {{ Auth::user()->full_name }}</h1>
        @else
            <h1>Purradox Game Studio</h1>
        @endif
    @endauth
    <br>
    <div class="container text-center">
        <!-- Top Row -->
        <div class="row justify-content-md-center mb-5">
            <div class="col-sm-5 dashboard me-5 p-3">
                <h2 class="text-sm-start fw-bold">Mission</h2>
                <p class="fs-5 text-sm-start">To develop games that encourage critical thinking and promote sustainable actions toward our natural environment 
                    whilst offering valuable entertainment for gamers and the like.</p>
                <h2 class="text-sm-start fw-bold">Vision</h2>
                <p class="fs-5 text-sm-start">To assemble a community that aligns with our inclined game themes and concepts.</p>
            </div>
            <div class="col-sm-4">
                <div class="row d-flex flex-column justify-content-between" style="height: 100%;">
                    <div class="col-12 dashboard p-3">
                        <h4 class="fw-bold">Latest Job Listing</h4>
                        @if($latestJob)
                            <h5>{{ $latestJob->job_role }} {{ $latestJob->job_title }}</h5>
                            <p class="fs-5 text-center">Last updated on {{ $latestJob->updated_at->format('F j, Y - g:i A') }}</p>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    </div>
                    <div class="col-12 dashboard p-3">
                        <h4 class="fw-bold">Oldest Job Listing</h4>
                        @if($oldestJob)
                            <h5>{{ $oldestJob->job_role }} {{ $oldestJob->job_title }}</h5>
                            <p class="fs-5 text-center">Last updated on {{ $oldestJob->updated_at->format('F j, Y - g:i A') }}</p>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Row -->
        <div class="row justify-content-md-center">
            <div class="col-sm-3 dashboard me-4 p-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <h4>Jobs</h4>
                        @if($jobCount)
                            <h1 style="color: black;">{{ $jobCount }}</h1>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @else
                        <h4>Job Listings</h4>
                        @if($availableJobCount)
                            <h1 style="color: black;">{{ $availableJobCount }}</h1>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @endif
                @endauth
            </div>
            <div class="col-sm-3 dashboard me-4 p-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <h4>HIRED Employees</h4>
                        @if($hiredCount)
                            <h1 style="color: black;">{{ $hiredCount }}</h1>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @else
                        <h4>Employment Status</h4>
                        @if($employmentStatus)
                            <h1 style="color: black;">{{ $employmentStatus }}</h1>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @endif
                @endauth
            </div>
            <div class="col-sm-3 dashboard p-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <h4>PENDING Applications</h4>
                        @if($pendingCount)
                            <h1 style="color: black;">{{ $pendingCount }}</h1>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @else
                        <h4>Application Status</h4>
                        @if($applicationStatus)
                            <h1 style="color: black;">{{ $applicationStatus }}</h1>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection