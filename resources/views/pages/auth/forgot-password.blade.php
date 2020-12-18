@extends('layouts.blank')

@section('title')
Forgot password | {{ config('app.name') }}
@endsection

@section('content')
<div class="forgot-password-form">
    <form class="form" method="POST" action="{{ route('password.request') }}">
        @csrf

        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
        </a>

        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <h3 class="heading">Reset password</h3>

        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="email" class="form-control @error('email') invalid @enderror" placeholder="Example: averyjordan@mail.com" name="email">
            @error('email')
            <span class="form-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Reset</button>

        <p>Don't have an account? Register <a href="/register">here</a>.</p>
    </form>
</div>
@endsection