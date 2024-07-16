@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white">Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_id }}</td>
                <td>{{ $order->product_id }}</td>
                <td>{{ $order->quantity }}</td>
                <td>${{ number_format($order->total_price, 2) }}</td>
                <td>{{ $order->status }}</td>
                <!-- Display other order information -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $orders->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
