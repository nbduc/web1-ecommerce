@extends('layouts.master')

@section('title')
{{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="search_header">
        <h1 class="search_text">Your search for "{{ $search }}" revealed the following:</h1>
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
            @foreach ($products as $product)
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
    {{ $products->links() }}
</div>
@endsection