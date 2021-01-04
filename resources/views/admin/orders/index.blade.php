@extends('admin.layouts.base')

@section('title')
    Order Management | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Orders') }}
    </div>
    <div class="card-body">
        <form class="mt-2 mb-2" action="{{ route('admin.orders.search') }}" method="GET">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search with customer name or email">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
        <br>
        <table class="table table-responsive-sm table-striped" id="products_table">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Customer</th>
                    <th>Ship date</th>
                    <th>Ship address</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->ship_date }}</td>
                        <td>{{ $order->ship_address }}</td>
                        <td>
                            <span class="{{ $order->status->class }}">
                                {{ $order->status->name }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                class="btn btn-block btn-primary" role="button">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>

@endsection
