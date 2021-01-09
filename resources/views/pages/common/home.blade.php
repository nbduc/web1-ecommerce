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
            <div class="carousel-cell">
                <img class="carousel-cell-image" src="{{ url('images/Note-20-banner.jpg') }}" alt="note20-banner">
            </div>
            <div class="carousel-cell">
                <img class="carousel-cell-image" src="{{ url('images/iphone12-banner.jpg') }}" alt="iphone12-banner">
            </div>
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
                @foreach ($newProducts as $product)
                <div class="col-md-2">
                    <a href="{{ route('product.show', $product->id) }}" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url({{ $product->feature_img }});"></div>
                        <h4 class="product-list-item__name">{{ $product->name }}</h4>
                        <div class="product-list-item__price">
                            <span>${{ $product->price }}</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>{{ $product->favouritesCount() }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <hr>
        <div class="product-list__header">
            <h2 class="product-list__header-left">Top-selling products</h2>
            <div class="product-list__header-right">
                <a href="#">More products ›</a>
            </div>
        </div>
        <div class="product-list__main">
            <div class="row">
                @foreach ($topSellingProducts as $product)
                <div class="col-md-2">
                    <a href="{{ route('product.show', $product->id) }}" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url({{ $product->feature_img }});"></div>
                        <h4 class="product-list-item__name">{{ $product->name }}</h4>
                        <div class="product-list-item__price">
                            <span>${{ $product->price }}</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>{{ $product->favouritesCount() }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <hr>
        <div class="product-list__header">
            <h2 class="product-list__header-left">Most popular products</h2>
            <div class="product-list__header-right">
                <a href="#">More products ›</a>
            </div>
        </div>
        <div class="product-list__main">
            <div class="row">
                @foreach ($mostPopularProducts as $product)
                <div class="col-md-2">
                    <a href="{{ route('product.show', $product->id) }}" class="product-list-item">
                        <div class="product-list-item__img" style="background-image: url({{ $product->feature_img }});"></div>
                        <h4 class="product-list-item__name">{{ $product->name }}</h4>
                        <div class="product-list-item__price">
                            <span>${{ $product->price }}</span>
                        </div>
                        <div class="product-list-item__votes">
                            <i class="product-list-item__vote-icon fas fa-heart"></i>
                            <span>{{ $product->favouritesCount() }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
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