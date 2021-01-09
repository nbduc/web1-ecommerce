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
        <span class="breadcrumb--truncate">{{ $product->name }}</span>
    </nav>
    <div class="row">
        <div class="col-sm-5 product_images">
            <div class="product_images-wrapper"></div>
            <div class="product_images-thumb row">
                {{-- product images here --}}
                @foreach ($product->productImages as $image)
                <div class="product_images-thumb-item col-sm-3"
                    style="background-image: url({{ $image->url }})"></div>
                @endforeach
                
            </div>
        </div>
        <div class="col-sm-7">
            <h1 class="product_name">{{ $product->name }}</h1>
            <div id="product" data-productid="{{ $product->id }}">
                <ul class="product_meta">
                    <li class="product_price"><span>${{ $product->price }}</span></li>
                    <li class="product_votes @if($you->favourites->pluck('product_id')->contains($product->id)){{ __('product_votes--voted')}}@endif">
                        <a href="javascript:;" onclick="addToFavourites(event);" class="product_votes-add-link" title="Add to my favourites">
                            <i class="far fa-heart"></i>
                            <span class="product_votes-count">{{ $product->favouritesCount() }}</span>
                        </a>
                        <a href="javascript:;" onclick="removeFromFavourites(event);" class="product_votes-remove-link" title="Remove from my favourites">
                            <i class="fas fa-heart"></i>
                            <span class="product_votes-count">{{ $product->favouritesCount() }}</span>
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
                <div class="product_desc">
                    {{ $product->description }}
                </div>
            </div>
            
        </div>
    </div>
    <hr>
    <div class="box-comment row">
        <div class="col-md-8">
            <h2 class="box-comment__title">
                <span>Comments</span>
                <span class="box-comment__count">{{ $product->commentsCount() }} comments</span>
            </h2>
            <div class="box-comment__list">
                <p class="box-comment__list-title"><strong>Leave a Comment</strong></p>
                <div class="box-comment__list-textarea">
                    <textarea name="comment" id="comment" rows="3" placeholder="Type your comment here"></textarea>
                    <button class="btn btn-primary">Post</button>
                </div>
                @foreach ($product->comments as $comment)
                <div class="box-comment__list-item">
                    <div class="box-comment__avatar-text">{{ $comment->user->name[0] }}</div>
                    <div class="box-comment__main">
                        <h3 class="box-comment__user-name">{{ $comment->user->name }}</h3>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
                @endforeach
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
        const product = document.querySelector('#product');
        const productId = product.dataset.productid;
        postData('{{ route('user.favourites.store') }}', { productId })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
            product.classList.add('product_votes--voted');
            const votesCountElements = document.querySelectorAll('.product_votes-count');
            votesCountElements.forEach(function (element) {
                console.log(element.innerHTML);
                element.innerHTML = parseInt(element.innerHTML) + 1;
            });
        });
    }
</script>
<script>
    function removeFromFavourites(e) {
        const product = document.querySelector('#product');
        const productId = product.dataset.productid;
        postData('{{ route('user.favourites.destroy') }}', { productId, _method: 'DELETE' })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
            product.classList.remove('product_votes--voted');
            const votesCountElements = document.querySelectorAll('.product_votes-count');
            votesCountElements.forEach(function (element) {
                element.innerHTML = parseInt(element.innerHTML) - 1;
            });
        });
    }
</script>
<script>
    function addToCart(e) {
        e.preventDefault();
        const product = document.querySelector('#product');
        const productId = product.dataset.productid;
        const quantityInput = document.querySelector('input[name="quantity"]');
        const quantity = parseInt(quantityInput.getAttribute('value'));
        postData('{{ route('user.cart.update') }}', { productId, quantity })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
            updateCart({diff: quantity, quantity: 0});
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