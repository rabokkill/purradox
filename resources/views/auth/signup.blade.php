@extends('layouts.app')
@section('content')
<video autoplay loop muted plays-inline class="background-vid">
    <source src="Assets/background-vid.mp4" type="video/mp4">
</video>
<div class="col-sm-4 account">
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
    <form action="{{ route('signup') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required oninput="capitalizeFirstLetter(this)"
            value="{{ old('first_name') }}">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" required oninput="capitalizeFirstLetter(this)" 
            value="{{ old('last_name') }}">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" required oninput="usernameValidation(this)" 
            value="{{ old('username') }}">
            <small id="error-message" style="color: red; display: none;">Only lowercase letters, numbers, and underscores are allowed.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required onkeydown="checkCapsLock(event)">
            <small id="capsLockWarning" style="color: red; display: none;">Caps Lock is ON</small>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required onkeydown="checkCapsLock(event)">
        </div>
        <?php if (isset($_SESSION['error'])): ?>
            <span style="color: red;"><?php echo $_SESSION['error']; ?></span>
            <?php unset($_SESSION['error']);?>
        <?php endif; ?>
        <div class="view-password">
            <input type="checkbox" class="view-password" onclick="viewPassword(this)" id="showPassword">
            <label for="showPassword">Show Password</label>
        </div>
        <button type="submit" class="btn btn-account">Submit</button>
        <a href="{{ route('show.login') }}">Already have an account? Login here.</a>
    </form>
    <!-- Form End -->
</div>
@endsection