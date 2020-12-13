@extends('admin.layouts.base')

@section('title')
    {{ $user->name }} | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Invoices</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action"><strong>Email:</strong> {{ $user->email }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Email verified at:</strong> {{ $user->email_verified_at }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Roles:</strong> @foreach($user->roles as $role)
                                <span class="{{ $role->class }}">
                                    {{ $role->name }}
                                </span>
                            @endforeach</li>
                        </ul>
                    </p>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection