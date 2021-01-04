@extends('admin.layouts.base')

@section('title')
    {{ $order->user->name }}'s Order | Admin {{ config('app.name') }}
@endsection

@section('content')
<!-- Position it -->
<div style="position: absolute; top: 0; right: 0;">

    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded mr-2" alt="...">
            <strong class="mr-auto">Bootstrap</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            See? Just like this.
        </div>
    </div>
</div>
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
                    <button type="submit" class="btn btn-primary" onclick="updateStatus(event, this);">Change</button>
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

@section('js')
<script>
    function updateStatus(event, button) {
        event.preventDefault();
        const form = button.parentElement;
        let url = form.action;
        let token = form.querySelector('input[name="_token"]').getAttribute('value');
        let method = form.querySelector('input[name="_method"]').getAttribute('value');

        let status;
        let ele = form.getElementsByTagName('input');
        for(i = 0; i < ele.length; i++) { 
            if(ele[i].type === "radio"){
                if(ele[i].checked) {
                    status = ele[i].value;
                }
            }
        } 
        console.log(url, token, status);

        fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                    },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    status_id: status,
                    _method: method
                }),
            }
        ).then((response) => {
            response.json()
            .then(messages => {
                console.log(messages);
                $('.toast').toast('show');
            })
        }).catch(function(error) {
            console.log(error);
        });
    }
</script>
@endsection