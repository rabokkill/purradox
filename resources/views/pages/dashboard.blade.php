@extends('layouts.app')
@section('content')
    @auth
        @if(auth()->user()->user_type === 'admin')
            <h1>Welcome to the Admin Page, {{ Auth::user()->full_name }}</h1>
        @else
            <h1>Purradox Game Studio</h1>
        @endif
    @endauth
@endsection