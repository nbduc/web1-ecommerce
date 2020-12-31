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
    <section class="main__carousel">
        <div class="carousel" data-flickity='{ "autoPlay": true }'>
            <div class="carousel-cell"></div>
            <div class="carousel-cell"></div>
            <div class="carousel-cell"></div>
            <div class="carousel-cell"></div>
            <div class="carousel-cell"></div>
        </div>
    </section>
    <section class="main__new-products product-list">
        <hr>
        <div class="product-list__header">
            <h2 class="product-list__header-left">New products</h2>
            <div class="product-list__header-right">
                <a href="#">More products ›</a>
            </div>
        </div>
        <div class="product-list__main">
            <div class="row">
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url(https://muagame.vn/cdn1/images/201711/goods_img/playstation-4-slim-500gb---ps4-may-cu-gia-re-P275-1511160235282.jpg);"></div>
                        <h4 class="product-list-item__name">Máy chơi game PlayStation 4 1TB Model 7128b - New Seal - Hàng chính hãng</h4>
                        <div class="product-list-item__price">
                            <span>$18,55</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>10</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
@auth
    @if(url()->previous() == route('login'))
    <script>
        toast({
            title: 'Login Successful',
            message: 'Welcome back!',
            type: 'success'
        });
    </script>
    @endif
    @if(!$you->hasVerifiedEmail())
    <script>
        toast({
            title: 'Verify email',
            message: 'You need to confirm your account. Please check your email.',
            type: 'warning'
        });
    </script>
    @endif
@endauth
@endsection