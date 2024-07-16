@extends('layouts.app')

@section('content')
    <div class="container mt-4 w-50 bg-dark border rounded-3 p-5">

        <h1 class="text-center text-light">Checkout</h1>
        @if (count($orders) == 0)
            <div class="text-white"> You currenly does not checkout anything yet.</div>
        @else
            <form class="w-100" action="{{ route('process.checkout') }}" method="POST">
                @csrf

                <ul class="list-group">

                    @foreach ($orders as $order)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center ">
                                    <img src="{{ asset('images/products/' . $order->product->image) }}"
                                        alt="{{ $order->product->name }}" class="img-fluid"
                                        style="max-width: 80px; max-height: 80px; margin-right: 15px;"
                                        onerror="this.onerror=null;this.src='{{ asset('images/websiteLogo/4.png') }}';">
                                    <div>
                                        <h5>{{ $order->product->name }}</h5>
                                        <p>Quantity: {{ $order->quantity }}<br>
                                            Size: {{ $order->size }}<br>
                                            Price: PHP{{ number_format($order->total_price, 2) }}</p>
                                    </div>
                                </div>
                                <div>
                                    <input type="checkbox" name="order_ids[]" value="{{ $order->id }}">
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Shipping Address -->
                <div class="mb-3">
                    <label for="shipping_address" class="form-label text-light">Shipping Address</label>
                    <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required></textarea>
                    <select class="form-select mt-2" id="shipping_method" name="shipping_method" required>
                        <option value="">Select Shipping Method</option>
                        <option value="Regular">Regular (3-5 days) (PHP 50)</option>
                        <option value="USPS">USPS (1-2 days)(PHP 150)</option>
                    </select>
                </div>

                <!-- Payment Mode -->
                <div class="mb-3">
                    <label for="payment_mode" class="form-label text-light">Payment Mode</label>
                    <select class="form-select" id="payment_mode" name="payment_mode" required>
                        <option value="">Select Payment Mode</option>
                        <option value="Cash">Cash on Delivery</option>
                        <option value="Card">Credit Card</option>
                        <option value="Online" disabled>Online Payment</option>
                    </select>
                </div>

                <!-- Credit Card Information -->
                <div id="credit-card-info" style="display: none;">
                    <div class="mb-3">
                        <label for="card_number" class="form-label text-light">Card Number</label>
                        <input type="text" class="form-control" id="card_number" name="card_number"
                            placeholder="Enter card number">
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label text-light">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY">
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label text-light">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV">
                    </div>
                </div>

                <div class="w-50 mx-auto">
                    <button type="submit" class="btn btn-primary mt-3 mx-auto w-100">Process Checkout</button>
                </div>
            </form>
        @endif
    </div>

    <script>
        document.getElementById('payment_mode').addEventListener('change', function() {
            var creditCardInfo = document.getElementById('credit-card-info');
            if (this.value === 'Card') {
                creditCardInfo.style.display = 'block';
            } else {
                creditCardInfo.style.display = 'none';
            }
        });
    </script>
@endsection
