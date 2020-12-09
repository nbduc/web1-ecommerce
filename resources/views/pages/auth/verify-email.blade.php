@extends('layouts.master')

@section('title')
Login | {{ config('app.name') }}
@endsection

@section('content')
<div class="verify-email-form">
    
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <p class="desc">You must verify your email address. Please check your email for a verification link.</p>

        <button type="submit" class="btn btn-primary">Re-send email</button>
    </form>
</div>
@endsection