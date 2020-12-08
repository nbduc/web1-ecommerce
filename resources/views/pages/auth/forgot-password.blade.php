@extends('layouts.master')

@section('title')
Forgot password | E-Shopper
@endsection

@section('content')
<div class="login-form">
    <h2>Reset password</h2>
    @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <form method="POST" action="{{ route('password.request') }}">
        @csrf
        <input type="email" placeholder="Email Address" name="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        
        <button type="submit" class="btn btn-default">Reset</button>
    </form>
    <p>Don't have an account? Register <a href="/register">here</a>.</p>
</div>
@endsection