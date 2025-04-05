<?php
    $host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'nekobytes_db';

    $conn = mysqli_connect($host,$db_user,$db_pass,$db_name);

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>