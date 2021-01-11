@extends('admin.layouts.base')

@section('title')
    {{ $products->name }} | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Infomation</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $products->name }}</h5>
                    <p class="card-text">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action"><strong>Description:</strong> {{ $products->description }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Price:</strong> {{ $products->price }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Likes:</strong> {{ $products->likes }}</li>
                            <li class="list-group-item list-group-item-action"><strong>In stock:</strong> {{ $products->in_stock }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Display:</strong> {{ $products->productDetail->display }}
                            </li>
                            <li class="list-group-item list-group-item-action"><strong>Front Camera:</strong> {{ $products->productDetail->front_camera }}
                            </li>
                            <li class="list-group-item list-group-item-action"><strong>Rear Camera:</strong> {{ $products->productDetail->rear_camera }}
                            </li>
                            <li class="list-group-item list-group-item-action"><strong>Storage:</strong> {{ $products->productDetail->storage }}
                            </li>
                            <li class="list-group-item list-group-item-action"><strong>Os:</strong> {{ $products->productDetail->os }}
                            </li>
                            <li class="list-group-item list-group-item-action"><strong>Images:</strong> <img src="{{ asset('images/upload/feature_products/'.$products->feature_img) }}" alt="" width="100" height="100">  </li>
                        </ul>
                    </p>
                    <a href="{{ route('admin.products.edit', $products->id) }}" class="btn btn-primary">Edit Information</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection