@extends('admin.layouts.base')

@section('title')
    Reportings | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Reports') }}
    </div>
    <div class="card-body">
        <form class="mt-2 mb-2" action="{{ route('admin.reports.search') }}" method="GET">
            <div class="input-group">
                <div class ="form-group">
                    Start Date: <input type = "date" class = "form-control" name ="date_from" placeholder ="Input Field">
                </div>
                <div class ="form-group">
                    End Date: <input type = "date" class = "form-control" name ="date_to" placeholder ="Input Field">
                </div>
                
            </div>
            <span class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
        </form>
        <br>
        <table class="table table-responsive-sm table-striped" id="products_table">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Product ID</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Address</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($reports as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @foreach($order->orderDetails as $orderDetails)
                                <span class="{{ $orderDetails->class }}">
                                    {{ $orderDetails->product_id }}
                                </span>   
                                @endforeach    
                        </td>
                        <td>
                                @foreach($order->orderDetails as $orderDetails)
                                <span class="{{ $orderDetails->class }}">
                                    {{ $orderDetails->unit_price }}
                                </span>
                                @endforeach
                        </td>
                        <td>
                                @foreach($order->orderDetails as $orderDetails)
                                <span class="{{ $orderDetails->class }}">
                                    {{ $orderDetails->quantity }}
                                </span>
                                @endforeach
                        </td>
                        <td> {{ $order->ship_address }}</td>
                        <td> {{ $order->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>
</div>

@endsection
