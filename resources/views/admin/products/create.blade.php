@extends('admin.layouts.base')

@section('title')
    Create new product | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create new product') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @include('admin.products.includes.form', ['create' => true])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection