<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="Assets/panda.png">
    <meta charset="UTF-8">
    <meta name="viewport" body="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('assets/style.css')}}">
</head>
<body>
    <div class="container-fluid">
        @auth
            @if(auth()->user()->id === 1)
                @include('layouts.sidebar')
                <div class="col-sm-10 content">
                    @yield('content')
                </div>
            @endif
        @endauth
        @guest
            @yield('content')
        @endguest
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{url('assets/script.js')}}"></script>
</body>
</html>