@extends('layouts.master')

@section('title')
Success order | {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="order__messages-wrapper">
        <div class="order__messages">
            Your order have been received.
        </div>
        <div class="order__thank-you">
            Thank you for your purchase!
        </div>
        <a href="{{ url('/') }}" type="button" class="btn btn-primary order__redirect-btn">Continue shopping</a>
    </div>
</div>
@endsection