@extends('layouts.master')

@section('title')
Cart | {{ config('app.name') }}
@endsection

@section('content')
<div id="toast"></div>
<div class="container">
    <h2 class="cart__header">
        <span>Shopping cart</span>
    </h2>
    <hr>
    
    <div class="cart__wrapper @if($cart->totalQuantity() <= 0){{ __('cart--empty') }}@endif">
        <div class="cart__empty">
            <img class="cart__empty-img" src="{{ url('images/empty-cart.png') }}" alt="empty-cart">
            <p class="cart__empty-message">
                Your cart is currently empty :((
                <small style="display: block">
                    Looks like you have no items in your shopping cart.
                    Click <a href="{{ url('/') }}">here</a> to return to shop.
                </small>
            </p>
        </div>
        <div class="row cart__main">
            <div class="col-md-8">
                <ul class="cart__list">
                    @foreach ($cart->cartItems as $item)
                    <li class="cart__list-item" id="{{ $item->product_id }}" data-price="{{ $item->unit_price }}">
                        <div class="cart-item__img" 
                            style="background-image: url({{ $item->product->feature_img }})"></div>
                        <div class="cart-item__content">
                            <div class="cart-item__desc">
                                <div class="cart-item__product-name">
                                    <a href="{{ route('product.show', $item->product->id) }}">{{ $item->product->name }}</a>
                                </div>
                                <div class="cart-item__actions">
                                    <a href="javascript:;" title="Remove from my cart" onclick="removeFromCart(event, this);">Remove</a>
                                </div>
                            </div>
                            <div class="cart-item__details">
                                <div class="cart-item__price">
                                    ${{ $item->unit_price }}
                                </div>
                                <div class="cart-item__quantity">
                                    <div class="cart-item__quantity--inner">
                                        <div class="cart-item__quantity-descrease" onclick="descreaseQuantity(this);">-</div>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" onchange="updateQuantity(this);">
                                        <div class="cart-item__quantity-increase" onclick="increaseQuantity(this);">+</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4">
                <div class="cart__address">
                    <p class="cart__address-heading">
                        Shipping address
                        <a href="{{ route('user.profile.index') }}">Change</a>
                    </p>
                    <p class="cart__address-title">
                        <b class="cart__address-name">{{ $you->name }}</b>
                    </p>
                    <span class="cart__address-content">
                        
                        @if($you->customerData->phone !== null || $you->customerData->email !== null)
                        Phone: {{ $you->customerData->phone }}
                        <br>
                        Ship address: {{ $you->customerData->ship_address }}
                        @else
                        <small style="display: block;">You have not provided your shipping address and phone number!</small>
                        Add phone and ship address <a href="{{ route('user.profile.index') }}">here</a>.
                        @endif
                    </span>
                </div>
                <hr>
                <div class="cart__total">
                    <span class="cart__total-text">Total</span>
                    <span class="cart__total-value">${{ $cart->totalPrice() }}</span>
                </div>
                <a type="button" href="{{ route('user.order.index') }}" class="btn btn-primary cart__submit">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function updateTotalPrice(){
        const items = document.querySelectorAll('.cart__list-item');
        let total = 0;
        items.forEach(item => {
            const quantity = parseInt(item.querySelector('input[name="quantity"]').getAttribute('value'));
            const unitPrice = parseFloat(item.dataset.price);
            total += quantity*unitPrice;
        });
        const totalPriceElement = document.querySelector('.cart__total-value');
        totalPriceElement.innerHTML = `$${total}`;

    }
    function descreaseQuantity(element, min = 1){
        const productItem = getParent(element, '.cart__list-item');
        const productId = productItem.id;
        let quantityInput = productItem.querySelector('input[name="quantity"]');
        let quantity = parseInt(quantityInput.getAttribute('value'));
        quantity--;
        if(quantity < min){
            quantity = min;
        }
        quantityInput.setAttribute('value', quantity);

        postData('{{ route('user.cart.update') }}', { productId, descrement: 1 })
        .then(messages => {
            updateCart({diff: -1, quantity: 0});
            updateTotalPrice();
        });
    }
    function increaseQuantity(element){
        const productItem = getParent(element, '.cart__list-item');
        const productId = productItem.id;
        let quantityInput = productItem.querySelector('input[name="quantity"]');
        let quantity = parseInt(quantityInput.getAttribute('value'));
        quantity++;
        quantityInput.setAttribute('value', quantity);

        postData('{{ route('user.cart.update') }}', { productId, increment: 1 })
        .then(messages => {
            updateCart({diff: 1, quantity: 0});
            updateTotalPrice();
        });
    }
    function updateQuantity(element){
        const productItem = getParent(element, '.cart__list-item');
        const productId = productItem.id;
        let quantityInput = productItem.querySelector('input[name="quantity"]');
        let quantity = parseInt(quantityInput.getAttribute('value'));

        postData('{{ route('user.cart.update') }}', { productId, updatedQuantity: quantity })
        .then(messages => {
            updateCart({diff: 0, quantity: quantity});
            updateTotalPrice();
        });
    }
</script>
<script>
    function removeFromCart(e, element) {
        e.preventDefault();
        const productItem = getParent(element, '.cart__list-item');
        const productId = productItem.id;
        let quantityInput = productItem.querySelector('input[name="quantity"]');
        let quantity = parseInt(quantityInput.getAttribute('value'));
        postData('{{ route('user.cart.remove') }}', { productId, _method: "DELETE" })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
            productItem.parentNode.removeChild(productItem);
            console.log((-1)*quantity);
            updateCart({diff: (-1)*quantity, quantity: 0});
            const itemCount = document.querySelector('.cart__list').childElementCount;
            if(itemCount === 0){
                document.querySelector('.cart__wrapper').classList.add('cart--empty');
            }
            updateTotalPrice();
        });
    }
</script>
@endsection