@extends('layouts.master')

@section('title')
Register | E-Shopper
@endsection

@section('content')
<div class="signup-form">
    <h2>New User Signup!</h2>
    <form method="POST" action="{{ route('register') }}">
    @csrf
        <input type="text" placeholder="Name" @error('name') is-invalid @enderror name="name">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
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
        <input type="password" placeholder="Confirm password" name="password_confirmation">
        <button type="submit" class="btn btn-default">Signup</button>
    </form>
    <p>Already have an account? Login <a href="/login">here</a>.</p>
</div>
@endsection