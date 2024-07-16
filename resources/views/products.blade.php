@extends('layouts.app')

@section('content')
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
        }
    </style>

    <!-- Main Content -->

    <div class="container mt-4">
        @php
            $genders = ['male', 'female'];
            $seasons = ['summer', 'winter'];
            $categories = ['casual', 'formal'];
        @endphp
        <form action="{{ url()->current() }}" method="GET" class="mb-4">
            <div class="input-group">
                <select name="gender" class="form-select">
                    <option value="">Select Gender</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender }}" {{ request('gender') == $gender ? 'selected' : '' }}>
                            {{ ucfirst($gender) }}</option>
                    @endforeach
                </select>

                <select name="season" class="form-select">
                    <option value="">Select Season</option>
                    @foreach ($seasons as $season)
                        <option value="{{ $season }}" {{ request('season') == $season ? 'selected' : '' }}>
                            {{ ucfirst($season) }}</option>
                    @endforeach
                </select>

                <select name="category" class="form-select">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" class="form-control" placeholder="Search products"
                    value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <div class="row">
            @if ($products->isEmpty())
                <div class="col-md-12 text-center">
                    <p>No products found.</p>
                </div>
            @endif
            @foreach ($products as $product)
                <div class="col col-md-4 mb-2">
                    <div class="product-card bg-light h-100">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/websiteLogo/4.png') }}';">
                        <h5>{{ $product->name }}</h5>
                        <p>₱{{ number_format($product->price, 2) }}</p>
                        <p>{{ ucfirst($product->gender) }} / {{ ucfirst($product->season) }} /
                            {{ ucfirst($product->category) }}</p>
                        @auth
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addToCartModal{{ $product->id }}">
                                Add to Cart
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary mt-auto">Add to Cart</a>
                        @endauth
                    </div>
                </div>

                @auth
                    <!-- Add to Cart Modal -->
                    <div class="modal fade" id="addToCartModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="addToCartModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addToCartModalLabel{{ $product->id }}">Add
                                        {{ $product->name }}
                                        to Cart</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="productDescription{{ $product->id }}"
                                                class="form-label">Description:</label>
                                            <p id="productDescription{{ $product->id }}">{{ $product->description }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="size{{ $product->id }}" class="form-label">Size:</label>
                                            <select name="size" id="size{{ $product->id }}" class="form-select" required>
                                                <option value="small">Small ({{ $product->small }} pcs left)</option>
                                                <option value="medium">Medium ({{ $product->medium }} pcs left)</option>
                                                <option value="large">Large ({{ $product->large }} pcs left)</option>
                                                <option value="xlarge">Extra Large ({{ $product->xlarge }} pcs left)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity{{ $product->id }}" class="form-label">Quantity:</label>
                                            <input type="number" name="quantity" id="quantity{{ $product->id }}"
                                                class="form-control" min="1" value="1" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endauth
            @endforeach
        </div>

        <!-- Pagination Links -->
        {{ $products->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection
