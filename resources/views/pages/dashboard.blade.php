@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="col content">
    @auth
        @if(auth()->user()->isAdmin())
            <h1>Welcome to the Admin Page, {{ Auth::user()->full_name }}</h1>
        @else
            <h1>Purradox Game Studio</h1>
        @endif
    @endauth
</div>
@endsection