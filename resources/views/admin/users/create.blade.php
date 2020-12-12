@extends('admin.layouts.base')

@section('title')
    Create new user | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                    {{ __('Create new user') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @include('admin.users.includes.form', ['create' => true]);
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection