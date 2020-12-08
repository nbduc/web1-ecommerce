@extends('layouts.master')

@section('title')
Login | E-Shopper
@endsection

@section('content')
<div class="login-form">
    <h2>You must verify your email address. Please check your email for a verification link.</h2>
    @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-default">Re-send email</button>
    </form>
</div>
@endsection