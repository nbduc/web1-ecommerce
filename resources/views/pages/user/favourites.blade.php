@extends('layouts.master')

@section('title')
My favourites | {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <h2 class="order__title">
        <span>My favourites</span>
    </h2>
    <hr>
    <ul class="favourites__list">
        @foreach ($favourites as $item)
        <li class="favourites__item" id={{ $item->product_id }}>
            <div class="favourites-item__img" 
                style="background-image: url({{ $item->product->feature_img }})"></div>
            <div class="favourites-item__content">
                <div class="favourites-item__product-name">
                    <a href="{{ route('product.show', $item->product->id) }}">{{ $item->product->name }}</a>
                </div>
                <div class="favourites-item__details">
                    <div class="favourites-item__price">
                        ${{ $item->product->price }}
                    </div>
                </div>
                <div class="favourites-item__desc">
                    {{ $item->product->description }}
                </div>
                <div class="favourites-item__actions">
                    <a href="javascript:;" title="Remove from my favourites" onclick="removeFromFavourites(event, this);">Remove</a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection

@section('js')
<script>
    function removeFromFavourites(e, element) {
        e.preventDefault();
        const productItem = getParent(element, '.favourites__item');
        const productId = productItem.id;
        postData('{{ route('user.favourites.destroy') }}', { productId, _method: "DELETE" })
        .then(messages => {
            Object.keys(messages).forEach(function (key) {
                toast({
                    title: key,
                    message: messages[key],
                    type: key
                });
            });
            productItem.parentNode.removeChild(productItem);
        });
    }
</script>
@endsection