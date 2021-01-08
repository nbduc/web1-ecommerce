@extends('layouts.master')

@section('title')
Checkout | {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <h2 class="order__title">
        <span>Checkout</span>
    </h2>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <h3 class="order__header">Billing details</h3>
            <div class="billing-details">
                <h4 class="billing-details__title">Customer information</h4>
                <ul class="billing-details__customer-data">
                    <li>Name: <strong>{{ $you->name }}</strong></li>
                    <li>Phone: <strong>{{ $you->customerData->phone }}</strong></li>
                    <li>Ship address: <strong>{{ $you->customerData->ship_address }}</strong></li>
                </ul>
                <a type="button" class="btn btn-primary" style="width: 200px;" href="{{ route('user.profile.index') }}">Edit</a>
            </div>
            
        </div>
        <div class="col-md-6">
            <h3 class="order__header">Order summary</h3>
            <h4 class="order__section-header">
                <span>Order details: {{ $cart->totalQuantity() }} product(s)</span> 
                <span><a href="{{ route('user.cart.index') }}">Edit</a></span>
            </h4>
            <ul class="order__details">
                @foreach ($cart->cartItems as $item)
                <li class="order__details-item">
                    <div class="order__details-item-name">Leica M (Typ 240) Edition "Leica 60"</div>
                    <div class="order__details-item-price"><strong>{{ $item->quantity }}</strong> x {{ $item->unit_price }}đ</div>
                </li>
                @endforeach
                
            </ul>
            <hr>
            <h4>Order total</h4>
            <div class="order__total-price">
                <span>Total:</span>
                <span class="order__total-price-number">{{ $cart->totalPrice() }}đ</span>
            </div>
            
        </div>
    </div>
    <hr>
    <div class="order__place-order">
        <form action="{{ route('user.order.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger" style="width: 200px;">Place order</button>
        </form>
        <p>(Please check your order before placing your order)</p>
    </div>
</div>
@endsection