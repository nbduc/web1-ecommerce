@extends('layouts.master')

@section('title')
Cart | {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <h2 class="cart__header">
        <span>Shopping cart</span>
        <span class="cart__header-count">{{ $cart->totalQuantity() }} product</span>
    </h2>
    <hr>
    @if($cart->totalQuantity() <= 0)
    <img class="cart_empty-img" src="{{ url('images/empty-cart.png') }}" alt="empty-cart">
    <p class="cart_empty-message">
        Your cart is currently empty :((
        <small style="display: block">
            Looks like you have no items in your shopping cart.
            Click <a href="{{ url('/') }}">here</a> to return to shop.
        </small>
    </p>
    
    @else
    <div class="row">
        <div class="col-md-8">
            <ul class="cart_list">
                <li class="cart_list-item">
                    <div class="cart-item__img" 
                        style="background-image: url(https://cdn.shopify.com/s/files/1/0543/1637/products/Leica_M_Edition_60_1_1024x1024@2x.jpg?v=1484764172)"></div>
                    <div class="cart-item__content">
                        <div class="cart-item__desc">
                            <div class="cart-item__product-name">
                                <a href="">Leica M (Typ 240) Edition "Leica 60"</a>
                            </div>
                            <div class="cart-item__actions">
                                <a href="#">Remove</a>
                            </div>
                        </div>
                        <div class="cart-item__details">
                            <div class="cart-item__price">
                                {{ $cart->totalPrice() }}đ
                            </div>
                            <div class="cart-item__quantity">
                                <div class="cart-item__quantity--inner">
                                    <div class="cart-item__quantity-descrease" onclick="descreaseQuantity();">-</div>
                                    <input type="number" name="quantity" value="1" onchange="updateQuantity();">
                                    <div class="cart-item__quantity-increase" onclick="increaseQuantity();">+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <div class="cart__address">
                <p class="cart__address-heading">Shipping address</p>
                <p class="cart__address-title">
                    <b class="cart__address-name">Peter Powell</b>
                    <b class="cart__address-phone">015-293847</b>
                </p>
                <p class="cart__address-content">4545  Cambridge Drive, Phoenix, Arizona</p>
            </div>
            <hr>
            <div class="cart__total">
                <span class="cart__total-text">Total</span>
                <span class="cart__total-value">{{ $cart->totalPrice() }}đ</span>
            </div>
            <button type="button" class="btn btn-primary cart__submit">Checkout</button>
        </div>
    </div>
    @endif
</div>
@endsection

@section('js')
<script>
    function descreaseQuantity(min = 1){
        let quantityInput = document.querySelector('input[name="quantity"]');
        let quantity = parseInt(quantityInput.getAttribute('value'));
        quantity--;
        if(quantity < min){
            quantity = min;
        }
        quantityInput.setAttribute('value', quantity);

        postData('{{ route('user.cart.update') }}', { productId: 1, descrement: 1 })
        .then(messages => {
            console.log(messages);
        });
    }
    function increaseQuantity(){
        let quantityInput = document.querySelector('input[name="quantity"]');
        let quantity = parseInt(quantityInput.getAttribute('value'));
        quantity++;
        quantityInput.setAttribute('value', quantity);

        postData('{{ route('user.cart.update') }}', { productId: 1, increment: 1 })
        .then(messages => {
            console.log(messages);
        });
    }
    function updateQuantity(){
        let quantityInput = document.querySelector('input[name="quantity"]');
        let quantity = parseInt(quantityInput.getAttribute('value'));
        console.log(quantity);

        postData('{{ route('user.cart.update') }}', { productId: 1, updatedQuantity: quantity })
        .then(messages => {
            console.log(messages);
        });
    }
</script>
@endsection