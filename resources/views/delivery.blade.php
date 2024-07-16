<!-- resources/views/delivery.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-white">Delivery Orders</h1>
    <div class="row">
        @foreach($deliveries as $delivery)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Order ID: {{ $delivery->order->id }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Product: {{ $delivery->order->product->name }}</h5>
                    <p class="card-text">Size: {{ $delivery->order->size }}</p>
                    <p class="card-text">Quantity: {{ $delivery->order->quantity }}</p>
                    <p class="card-text">Shipping Address: {{ $delivery->shipping_address }}</p>
                    <p class="card-text">Payment Mode: {{ $delivery->payment_mode }}</p>
                    <p class="card-text">Status: {{ $delivery->status }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#updateStatusModal{{ $delivery->id }}">
                        View / Update Status
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="updateStatusModal{{ $delivery->id }}" tabindex="-1" aria-labelledby="updateStatusModalLabel{{ $delivery->id }}"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel{{ $delivery->id }}">Update Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('delivery.update', ['id' => $delivery->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Current Status</label>
                                <input type="text" class="form-control" id="status" value="{{ $delivery->status }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="new_status" class="form-label">New Status</label>
                                <select class="form-select" id="new_status" name="new_status" required>
                                    @if($delivery->status === 'pending')
                                    <option value="on the way">On the Way</option>
                                    @elseif($delivery->status === 'on the way')
                                    <option value="delivered">Delivered</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
