<?php
@include('functions.mysql_connect');
@include('functions.user_data');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
    <?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="Assets/panda.png">
    <meta charset="UTF-8">
    <meta name="viewport" body="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('assets/style.css')}}">
</head>
<body>
    <div class="container-fluid">
        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>