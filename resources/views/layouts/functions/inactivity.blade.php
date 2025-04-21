<?php
    // timeout_duration = (minutes) * (60 seconds)
    $timeout_duration = 10 * 60;

    if (isset($_SESSION['timeout'])) {
        $elapsed_time = time() - $_SESSION['timeout'];

        if ($elapsed_time > $timeout_duration) {
            session_unset();
            session_destroy();
            echo '<script>alert("You have been logged out due to inactivity.");
                window.location.href = "login.php";</script>';
            die();
        }
    }
    $_SESSION['timeout'] = time();
?>