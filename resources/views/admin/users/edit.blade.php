@extends('admin.layouts.base')

@section('title')
    Edit user | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit user') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @method('PATCH')
                        @include('admin.users.includes.form');
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection