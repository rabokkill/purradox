@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    @auth
        @if(auth()->user()->isAdmin())
            <h1 class="page-title">Welcome to the Admin Page, {{ Auth::user()->full_name }}</h1>
        @else
            <h1 class="page-title">Purradox Game Studio</h1>
        @endif
    @endauth
    <br>
    <div class="container text-center">
        <!-- Top Row -->
        <div class="row justify-content-md-center mb-4">
            <div class="col-sm-5 dashboard me-5 p-3">
                <h3 class="text-sm-start fw-bold">Mission</h3>
                <p class="fs-6 text-sm-start">To develop games that encourage critical thinking and promote sustainable actions toward our natural environment 
                    whilst offering valuable entertainment for gamers and the like.</p>
                <br>
                <h3 class="text-sm-start fw-bold">Vision</h3>
                <p class="fs-6 text-sm-start">To assemble a community that aligns with our inclined game themes and concepts.</p>
            </div>
            <div class="col-sm-4">
                <div class="row d-flex flex-column justify-content-between" style="height: 100%;">
                    <div class="col-12 dashboard mb-2 p-3">
                        <h4 class="fw-bold">Latest Job Listing</h4>
                        <hr>
                        @if($latestJob)
                            <h5>{{ $latestJob->job_role }} {{ $latestJob->job_title }}</h5>
                            <p class="fs-6 textcenter">Last updated on {{ $latestJob->updated_at->format('F j, Y - g:i A') }}</p>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    </div>
                    <div class="col-12 dashboard p-3">
                        <h4 class="fw-bold">Oldest Job Listing</h4>
                        <hr>
                        @if($oldestJob)
                            <h5>{{ $oldestJob->job_role }} {{ $oldestJob->job_title }}</h5>
                            <p class="fs-6 text-center">Last updated on {{ $oldestJob->updated_at->format('F j, Y - g:i A') }}</p>
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
                        <hr>
                        @if($jobCount)
                            <h2>{{ $jobCount }}</h2>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @else
                        <h4>Job Listings</h4>
                        <hr>
                        @if($availableJobCount)
                            <h2>{{ $availableJobCount }}</h2>
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
                        <hr>
                        @if($hiredCount)
                            <h2>{{ $hiredCount }}</h2>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @else
                        <h4>Employment Status</h4>
                        <hr>
                        @if($employmentStatus)
                            <h2>{{ $employmentStatus }}</h2>
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
                        <hr>
                        @if($pendingCount)
                            <h2>{{ $pendingCount }}</h2>
                        @else
                            <p class="fs-5 text-center">- none -</p>
                        @endif
                    @else
                        <h4>Application Status</h4>
                        <hr>
                        @if($applicationStatus)
                            <h2>{{ $applicationStatus }}</h2>
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