<?php
$title = "Dashboard";
?>
@extends('layouts.app')
@section('content')
<!-- Sidebar -->
<div class="col-sm-2 sidebar">
<img src="{{url('assets/NekoBytesLogo.png')}}" style="width:80%;">
<ul class="nav nav-pills nav-stacked">
    <li><h6><i class="bi bi-person-circle"></i> {{ Auth::user()->username }}</h6></li>
    <li class="active text-center"><a href="user.php?page=dashboard"><i class="bi bi-house-door-fill"></i></a></li>
    <li><a href="user.php?page=jobs">Job Listings</a></li>
    <li><a href="user.php?page=employee">Employment Status</a></li>
    <li><a href="user.php?page=applicant">Application Status</a></li>
</ul>
<div id="today"></div>
<form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout" style="border: none; background: none;">
            <i class="bi bi-box-arrow-left"></i> Logout
        </button>
    </form>
</div>
<!-- Sidebar End -->
<!-- Content -->
<div class="col-sm-10 content">
    <h1>Welcome to the User Page, {{ Auth::user()->full_name }}</h1>
</div>
<!-- Content End -->
@endsection