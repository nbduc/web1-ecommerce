@extends('layouts.blank')

@section('title')
Login | {{ config('app.name') }}
@endsection

@section('content')
<div class="login-form">
    
    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <h3 class="heading">Sign into your account</h3>

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" class="form-control @error('email') invalid @enderror" 
            placeholder="Example: averyjordan@mail.com" name="email" value="{{ old('email') }}">
            @error('email')
            <span class="form-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control @error('password') invalid @enderror" 
            placeholder="***************" name="password">
            @error('password')
            <span class="form-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <span class="form-group form-checkbox">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember" class="form-label">Keep me signed in</label>
        </span>
        <button type="submit" class="btn btn-primary">Login</button>

        <p>Don't have an account? Register <a href="/register">here</a>.</p>
        <p><a href="/forgot-password">Forgot your password?</a></p>
    </form>
</div>
@endsection