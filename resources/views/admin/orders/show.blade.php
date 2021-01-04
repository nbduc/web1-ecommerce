@extends('admin.layouts.base')

@section('title')
    {{ $order->user->name }}'s Order | Admin {{ config('app.name') }}
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
        <div class="card">
            <div class="card-header">
                {{ $order->user->name }}'s Order
                <span class="{{ $order->status->class }}">
                    {{ $order->status->name }}
                </span>
            </div>
            <div class="card-body">
                <h5 class="card-title">Customer Information</h5>
                <p class="card-text">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action"><strong>Name:</strong> {{ $order->user->name }}</li>
                        <li class="list-group-item list-group-item-action"><strong>Email:</strong> {{ $order->user->email }}</li>
                        @isset($order->user->customerData)
                        <li class="list-group-item list-group-item-action"><strong>Phone:</strong> {{ $order->user->customerData->phone }}</li>
                        <li class="list-group-item list-group-item-action"><strong>Ship address (default):</strong> {{ $order->user->customerData->ship_address }}</li>
                        @else
                        <li class="list-group-item list-group-item-action"><strong>Phone:</strong></li>
                        <li class="list-group-item list-group-item-action"><strong>Ship address (default):</strong></li>
                        @endisset
                    </ul>
                </p>
                <hr>

                <h5 class="card-title">Order Status</h5>
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    @foreach ($statuses as $status)
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="radio" value="{{ $status->id }}" id="{{ $status->name }}"
                                @isset($order) @if($order->status->id == $status->id) checked @endif @endisset>
                            <label for="{{ $status->name }}" class="form-check-label">
                                <span class="{{ $status->class }}">
                                {{ $status->name }}
                                </span>
                            </label>
                        </div>
                    @endforeach
                    <br>
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
                <hr>

                <h5 class="card-title">Order Details</h5>
                <table class="table table-responsive-sm table-striped" id="products_table">
                    <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->product_id }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->unit_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection