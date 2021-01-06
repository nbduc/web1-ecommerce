@extends('layouts.master')

@section('title')
{{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="search_header">
        <h1 class="search_text">Your search for "cameras" revealed the following:</h1>
        <form action="/search" method="get" class="search-bar" role="search">
            <input type="hidden" name="type" value="product">
          
            <input class="search-bar_input" type="search" name="q" placeholder="Search all products..." aria-label="Search all products...">
            <button type="submit" class="search-bar_submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
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
        </div>
    </div>
</div>
@endsection