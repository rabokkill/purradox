<?php 
$title = "Login";

session_start();

$error = "Wrong username or password!";

if (isset($_SESSION['userID'])) {
    if ($_SESSION['user_type'] === 'EMPLOYER') {
        header("Location: admin.php");
        exit();
    } elseif ($_SESSION['user_type'] === 'APPLICANT') {
        header("Location: user.php");
        exit();
    } elseif ($_SESSION['user_type'] === 'EMPLOYEE') {
        header("Location: user.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = strtolower($username);

    if(!empty($username) && !empty($password)) {
        // read from database
        $query = "SELECT userID, username, password, user_type FROM tbl_users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn,$query);

        if($result && mysqli_num_rows($result) === 1) {
            $user_data = mysqli_fetch_assoc($result);

            if($user_data['password'] === $password) {
                $_SESSION['userID'] = $user_data['userID'];
                $_SESSION['user_type'] = $user_data['user_type'];

                if($user_data['user_type'] === "EMPLOYER"){
                    header("Location: admin.php");
                } elseif($user_data['user_type'] === "APPLICANT"){
                    header("Location: applicant.php");
                } elseif($user_data['user_type'] === "EMPLOYEE"){
                    header("Location: user.php");
                }
                exit();
            }
        } $_SESSION['error'] = $error;
    } else {
        $_SESSION['error'] = $error;
    }
}
?>
@extends('layouts.app')
@section('content')
<?php if (isset($_SESSION['error']) && $_SESSION['error']): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

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
    <form action="login.php" method="POST">
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
        <button type="submit" class="btn btn-primary btn-account">Login</button>
        <a href="{{url('/signup')}}">Create new applicant account here.</a>
    </form>
    <!-- Form End -->
</div>
@endsection