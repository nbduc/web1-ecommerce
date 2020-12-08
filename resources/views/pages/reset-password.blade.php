@extends('layouts.master')

@section('title')
Reset password | E-Shopper
@endsection

@section('content')
<div class="login-form">
    <h2>Reset password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="email" value={{ $request->email }} name="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        
        <input type="password" placeholder="New password" name="password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input type="password" placeholder="Confirm password" name="password_confirmation">
        <button type="submit" class="btn btn-default">Update</button>
    </form>
    <p>Don't have an account? Register <a href="/register">here</a>.</p>
</div>
@endsection