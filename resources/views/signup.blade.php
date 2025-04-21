<?php
$title = "Signup";

session_start();

$_SESSION['success'] = "Signup successful! You will now be redirected to the Login page.";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_type = 'APPLICANT';
    include ("Functions/signup_functions.php");
}
?>
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <video autoplay loop muted plays-inline class="background-vid">
        <source src="Assets/background-vid.mp4" type="video/mp4">
    </video>
    <div class="col-sm-4 account">
        <img src="Assets/NekoBytesLogo.png" class="logo">
        <h1 class="text-center"><?php echo $title; ?></h1>
        <!-- Error -->
        <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']);
            }
        ?>
        <!-- Error End -->
        <!-- Form -->
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" id="first_name" required oninput="capitalizeFirstLetter(this)">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="last_name" required oninput="capitalizeFirstLetter(this)">
            </div>
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
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required onkeydown="checkCapsLock(event)">
            </div>
            <?php if (isset($_SESSION['error'])): ?>
                <span style="color: red;"><?php echo $_SESSION['error']; ?></span>
                <?php unset($_SESSION['error']);?>
            <?php endif; ?>
            <div class="view-password">
                <input type="checkbox" class="view-password" onclick="viewPassword(this)" id="showPassword">
                <label for="showPassword">Show Password</label>
            </div>
            <button type="submit" class="btn btn-primary btn-account">Submit</button>
            <a href="{{url('/')}}">Already have an account? Login here.</a>
        </form>
        <!-- Form End -->
    </div>
@endsection