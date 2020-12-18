@extends('layouts.blank')

@section('title')
Register | {{ config('app.name') }}
@endsection

@section('content')
<div class="signup-form">
    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf

        <h3 class="heading">Register</h3>
        <p class="desc">Create your account. It's only take a minute.</p>

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" class="form-control @error('name') invalid @enderror" 
            placeholder="Example: Avery Jordan" name="name" value="{{ old('name') }}">
            @error('name')
            <span class="form-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
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
        
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Re-enter password</label>
            <input type="password" id="password_confirmation" class="form-control" 
            placeholder="***************" name="password_confirmation">
        </div>
        
        <button type="submit" class="btn btn-primary">Signup</button>

        <p>Already have an account? Login <a href="/login">here</a>.</p>
    </form>
</div>
@endsection