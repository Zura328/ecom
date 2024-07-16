@extends('layouts.app')

@section('content')
    <div class="container mt-4 w-75 bg-dark border rounded-3 p-5">
        <h1 class="text-center text-light">Pending Shipping Orders</h1>

        @if ($pendingOrders->isEmpty())
            <div class="alert alert-info text-center">No pending shipping orders</div>
        @else
            <ul class="list-group">
                @foreach ($pendingOrders as $shipping)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/products/' . $shipping->order->product->image) }}"
                                    alt="{{ $shipping->order->product->name }}" class="img-fluid"
                                    style="max-width: 80px; max-height: 80px; margin-right: 15px;"
                                    onerror="this.onerror=null;this.src='{{ asset('images/websiteLogo/4.png') }}';">
                                <div>
                                    <h5>{{ $shipping->order->product->name }}</h5>
                                    <p>Quantity: {{ $shipping->order->quantity }}<br>
                                        Size: {{ $shipping->order->size }}<br>
                                        Total Price(with shipping): PHP{{ number_format($shipping->order->total_price, 2) }}<br>
                                        Payment Mode: {{ $shipping->payment_mode }}<br>
                                        Shipping Address: {{ $shipping->shipping_address }}<br>
                                        Shipping Method: {{ $shipping->shipping_method }}<br>
                                        Status: {{ $shipping->status }}</p>
                                </div>
                            </div>
                            @if ($shipping->status == 'delivered')
                                <form action="{{ route('shipping.updateStatus', $shipping->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Mark as Received</button>
                                </form>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
