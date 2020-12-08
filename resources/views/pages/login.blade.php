@extends('layouts.master')

@section('title')
Login | E-Shopper
@endsection

@section('content')
<div class="login-form">
    <h2>Sign into your account</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" placeholder="Email Address" name="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input type="password" placeholder="Password" name="password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <span>
            <input type="checkbox" class="checkbox" name="remember">
            Keep me signed in
        </span>
        <button type="submit" class="btn btn-default">Login</button>
    </form>
    <p>Don't have an account? Register <a href="/register">here</a>.</p>
    <p><a href="#">Forgot your password?</a></p>
</div>
@endsection