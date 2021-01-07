@extends('layouts.master')

@section('title')
{{ config('app.name') }}
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endsection

@section('content')
<div class="container">
    <div id="toast"></div>
    <nav class="breadcrumb" role="navigation">
        <a href="{{ url('/') }}" title="Back to the frontpage">Home</a>
        <span class="divider" aria-hidden="true">›</span>
        <span class="breadcrumb--truncate">Leica M (Typ 240) Edition "Leica 60"</span>
    </nav>
    <div class="row">
        <div class="col-sm-5 product_images">
            <div class="product_images-wrapper"></div>
            <div class="product_images-thumb row">
                {{-- product images here --}}
                <div class="product_images-thumb-item col-sm-3"
                    style="background-image: url(https://cdn.shopify.com/s/files/1/0543/1637/products/Leica_M_Edition_60_1_1024x1024@2x.jpg?v=1484764172)"></div>
                <div class="product_images-thumb-item col-sm-3"
                    style="background-image: url(https://cdn.shopify.com/s/files/1/0543/1637/products/Leica_M_Edition_60_front_1024x1024@2x.jpg?v=1484764172)"></div>
            </div>
        </div>
        <div class="col-sm-7">
            <h1 class="product_name">Leica M (Typ 240) Edition "Leica 60"</h1>
            <div>
                <ul class="product_meta">
                    <li class="product_price"><span>$18,55</span></li>
                    <li class="product_votes product_votes--voted">
                        <a href="javascript:;" onclick="addToFavourites(event);" class="product_votes-add-link" title="Add to my favourites">
                            <i class="far fa-heart"></i>
                            <span>10</span>
                        </a>
                        <a href="javascript:;" onclick="removeFromFavourites(event);" class="product_votes-remove-link" title="Remove from my favourites">
                            <i class="fas fa-heart"></i>
                            <span>10</span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="cart-item__quantity">
                    <div class="cart-item__quantity--inner">
                        <div class="cart-item__quantity-descrease cart-item__quantity-disable" onclick="descreaseQuantity();">-</div>
                        <input type="tel" name="quantity" value="1">
                        <div class="cart-item__quantity-increase" onclick="increaseQuantity();">+</div>
                    </div>
                </div>
                <form action="#" method="POST" class="product_payment-form" enctype="multipart/form-data">
                    <div class="product_payment-buttons">
                        <button type="submit" class="btn btn-primary" onclick="addToCart(event);">
                            <i class="fas fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </div>
                </form>
                <hr>
            </div>
            
        </div>
    </div>
    <hr>
    <div class="box-comment row">
        <div class="col-md-8">
            <h2 class="box-comment__title">
                <span>Comments</span>
                <span class="box-comment__count">18 comments</span>
            </h2>
            <div class="box-comment__list">
                <p class="box-comment__list-title"><strong>Leave a Comment</strong></p>
                <div class="box-comment__list-textarea">
                    <textarea name="comment" id="comment" rows="3" placeholder="Type your comment here"></textarea>
                    <button class="btn btn-primary">Post</button>
                </div>
                <div class="box-comment__list-item">
                    <div class="box-comment__avatar-text">X</div>
                    <div class="box-comment__main">
                        <h3 class="box-comment__user-name">XSon</h3>
                        <p>The screen on this laptop is worth the price by itself. Gorgeous, black is actually black, it rivals my AOC gaming desktop monitor.</p>
                    </div>
                </div>
                <div class="box-comment__list-item">
                    <div class="box-comment__avatar-text">W</div>
                    <div class="box-comment__main">
                        <h3 class="box-comment__user-name">Will</h3>
                        <p>For what you're paying for the Screen and camera quality is what you pay for. There is a hard drive slot if you choose to expand your storage.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var imgWrapper = document.querySelector('.product_images-wrapper');
    var imgs = document.querySelectorAll('.product_images-thumb-item');
    if(imgs[0]){
        imgWrapper.style.backgroundImage = imgs[0].style.backgroundImage;
    }
    imgs.forEach(function(img){
        img.addEventListener('click', showImg);
    });
    function showImg(e) {
        var imgWrapper = document.querySelector(".product_images-wrapper");
        imgWrapper.style.backgroundImage = e.currentTarget.style.backgroundImage;
    }
</script>
<script>
    function addToFavourites(e) {
        postData('{{ route('user.favourites.store') }}', { productId: 1 })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
            document.querySelector('.product_votes').classList.add('product_votes--voted');
        });
    }
</script>
<script>
    function removeFromFavourites(e) {
        postData('{{ route('user.favourites.destroy') }}', { productId: 1, _method: 'DELETE' })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
            document.querySelector('.product_votes').classList.remove('product_votes--voted');
        });
    }
</script>
<script>
    function addToCart(e) {
        e.preventDefault();
        const quantityInput = document.querySelector('input[name="quantity"]');
        const quantity = parseInt(quantityInput.getAttribute('value'));
        postData('{{ route('user.cart.update') }}', { productId: 1, quantity })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
        });
    }
</script>
<script>
    function increaseQuantity(){
        let quantityInput = document.querySelector('input[name="quantity"]');
        let currentQuantity = parseInt(quantityInput.getAttribute('value'));
        currentQuantity++;
        quantityInput.setAttribute('value', currentQuantity);
    }
    function descreaseQuantity(min = 1){
        let quantityInput = document.querySelector('input[name="quantity"]');
        let currentQuantity = parseInt(quantityInput.getAttribute('value'));
        currentQuantity--;
        if(currentQuantity < min){
            currentQuantity = min;
        }
        quantityInput.setAttribute('value', currentQuantity);
    }
</script>
@endsection