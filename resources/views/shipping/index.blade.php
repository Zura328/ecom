@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white">Shipping Details</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Delivery Guy ID</th>
                <th>Payment Mode</th>
                <th>Shipping Address</th>
                <th>Status</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($shippings as $shipping)
            <tr>
                <td>{{ $shipping->id }}</td>
                <td>{{ $shipping->order_id }}</td>
                <td>{{ $shipping->delivery_guy_id }}</td>
                <td>{{ $shipping->payment_mode }}</td>
                <td>{{ $shipping->shipping_address }}</td>
                <td>{{ $shipping->status }}</td>
                <!-- Display other shipping information -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $shippings->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
