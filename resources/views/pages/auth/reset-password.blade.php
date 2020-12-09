@extends('layouts.master')

@section('title')
Reset password | {{ config('app.name') }}
@endsection

@section('content')
<div class="reset-password-form">
    <form class="form" method="POST" action="{{ route('password.update') }}">
        @csrf

        <h3 class="heading">Reset password</h3>

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email" class="form-label">Emai</label>
            <input type="email" id="email" class="form-control @error('email') invalid @enderror" 
            value={{ $request->email }} name="email">
            @error('email')
            <span class="form-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="new-password" class="form-label">New password</label>
            <input type="password" id="new-password" class="form-control" placeholder="***************" name="password">
            @error('password')
            <span class="form-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password-confirmation" class="form-label">Re-enter new password</label>
            <input type="password" id="password-confirmation" class="form-control" placeholder="***************" name="password_confirmation">
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection