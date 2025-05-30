<?php
$title='Login'
?>
@extends('layouts.app')
@section('content')
<video autoplay loop muted plays-inline class="background-vid">
    <source src="Assets/background-vid.mp4" type="video/mp4">
</video>
<div class="col-sm-8 col-md-7 col-lg-6 col-xl-5 col-xxl-4 account">
    <img src="Assets/Purradox-Logo.png" class="logo">
    <h1 class="text-center">{{ $title }}</h1>
    <!-- Error -->
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div class="text-center">{{ $error }}</div>
        @endforeach
    </div>
    @endif
    <!-- Form -->
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" required oninput="usernameValidation(this)">
            <small id="error-message" style="color: red; display: none;">Only lowercase letters, numbers, and underscores are allowed.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required onkeydown="checkCapsLock(event)">
            <small id="capsLockWarning" style="color: red; display: none;">Caps Lock is ON</small>
        </div>
        <div class="view-password">
            <input type="checkbox" class="view-password" onclick="viewPassword(this)" id="showPassword">
            <label for="showPassword">Show Password</label>
        </div>
        <button type="submit" class="btn btn-account">Login</button>
        <a href="{{ route('show.signup') }}">Create new applicant account here.</a>
    </form>
    <!-- Form End -->
</div>
@endsection