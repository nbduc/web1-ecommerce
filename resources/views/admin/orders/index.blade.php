@extends('admin.layouts.base')

@section('title')
    Order Management | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{ __('Orders') }}
        </div>
        <div class="card-body">
            <form class="mt-2 mb-2" action="{{ route('admin.order.search') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Search with customer name">
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
                        <th>Name</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <a href="{{ route('admin.products.show', $product->id) }}"
                                    class="btn btn-block btn-primary" role="button">View</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="btn btn-block btn-primary" role="button">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection
