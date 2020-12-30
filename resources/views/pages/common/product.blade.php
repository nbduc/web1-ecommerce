@extends('layouts.master')

@section('title')
{{ config('app.name') }}
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endsection

@section('content')
<div class="container">
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
                    <li class="product_votes">
                        <i class="fas fa-heart"></i>
                        <span>10</span>
                    </li>
                </ul>
                <form action="#" method="POST" class="product_payment-form" enctype="multipart/form-data">
                    <div class="product_payment-buttons">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </div>
                </form>
                <hr>
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
@endsection