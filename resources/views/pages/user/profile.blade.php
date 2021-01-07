@extends('layouts.master')

@section('title')
{{ $you->name }} | {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <h2 class="profile__heading">Your profile</h2>
    <hr>
    <div class="profile-form">
        <form method="POST" action="{{ route('user.profile.update') }}">
            @csrf

            @if(session('message'))
            <div class="alert alert-wanring" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <input type="hidden" name="redirectTo" value="{{ $redirectTo }}">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" class="form-control @error('name') invalid @enderror" name="name" value="{{ $you->name }}" placeholder="Enter your name.">
                @error('name')
                <span class="form-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control @error('email') invalid @enderror" name="email" value="{{ $you->email }}" placeholder="Enter your email.">
                @error('email')
                <span class="form-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Phone number</label>
                <input type="phone" id="phone" class="form-control @error('phone') invalid @enderror" name="phone" 
                value="@isset($you->customerData){{ $you->customerData->phone }}@endisset" placeholder="Enter your phone number.">
                @error('phone')
                <span class="form-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="ship_address" class="form-label">Ship address</label>
                <input type="text" id="ship_address" class="form-control @error('ship_address') invalid @enderror" name="ship_address" 
                value="@isset($you->customerData){{ $you->customerData->ship_address }}@endisset" placeholder="Enter your ship address.">
                @error('ship_address')
                <span class="form-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection