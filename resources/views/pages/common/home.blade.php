@extends('layouts.master')

@section('title')
{{ config('app.name') }}
@endsection

@section('content')
@auth
<a href="{{ url('/home') }}">Home</a>
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>@csrf</form>
@else
<a href="{{ route('login') }}">Login</a>
@if(Route::has('register'))
<a href="{{ route('register') }}">Register</a>
@endif
@endauth

@endsection