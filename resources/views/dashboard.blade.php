<?php
$title = "Dashboard";
?>
@extends('layouts.app')
@section('content')
<!-- Sidebar -->
<div class="col-sm-2 sidebar">
    <img src="Assets/NekoBytesLogo.png" style="width:80%;">
    <ul class="nav nav-pills nav-stacked">
        <li class="active text-center"><a href="admin.php?page=dashboard"><i class="bi bi-house-door-fill"></i></a></li>
        <li><a href="admin.php?page=jobs">Job Listings</a></li>
        <li><a href="admin.php?page=employees">Employees</a></li>
        <li><a href="admin.php?page=applicants">Applicants</a></li>
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
    <h1>Welcome to the Admin Page, {{ Auth::user()->full_name }}</h1>
</div>
<!-- Content End -->
@endsection