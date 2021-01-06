@extends('admin.layouts.base')

@section('title')
    Product Management | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{ __('Products') }}
        </div>
        <div class="card-body">
            <div class="row"> 
                <div class="col-md-3">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary m-2">Create new product</a>
                </div>
                <div class="col-md-6">
                    <form class="mt-2 mb-2" action="{{ route('admin.products.search') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control" placeholder="Search with name">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
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
