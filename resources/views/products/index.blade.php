@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-white float-start">Products</h1>
        <button type="button" class="btn btn-primary mb-3 float-end" data-toggle="modal" data-target="#addProductModal">
            <sup>+</sup> Add Product
        </button>


        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Gender</th>
                    <th>Small</th>
                    <th>Medium</th>
                    <th>Large</th>
                    <th>Xlarge</th>
                    <th>Season</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}"
                                    width="100">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $product->gender }}</td>
                        <td
                            class="
                        @if ($product->small <= 10) text-danger fw-bold
                        
                        @elseif ($product->small <= 20)   
                        text-warning fw-bold @endif">
                            {{ $product->small }}</td>
                        <td
                            class="
                        @if ($product->medium <= 10) text-danger fw-bold
                        
                        @elseif ($product->medium <= 20)   
                        text-warning fw-bold @endif">
                            {{ $product->medium }}</td>
                        <td
                            class="
                        @if ($product->large <= 10) text-danger fw-bold
                        
                        @elseif ($product->large <= 20)   
                        text-warning fw-bold @endif">
                            {{ $product->large }}</td>
                        <td
                            class="
                        @if ($product->xlarge <= 10) text-danger fw-bold
                        
                        @elseif ($product->xlarge <= 20)   
                        text-warning fw-bold @endif">
                            {{ $product->xlarge }}</td>
                        <td>{{ $product->season }}</td>
                        <td>{{ $product->category }}</td>
                        <td>
                            <!-- Add Stock button -->
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#stockModal{{ $product->id }}">
                                Stock
                            </button>

                            <!-- Stock Modal -->
                            <div class="modal fade" id="stockModal{{ $product->id }}" tabindex="-1"
                                aria-labelledby="stockModalLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('products.updateStock', $product->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="stockModalLabel{{ $product->id }}">Update
                                                    Stock for {{ $product->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="small">Small</label>
                                                    <input type="number" class="form-control" id="small" name="small"
                                                        value="{{ $product->small }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="medium">Medium</label>
                                                    <input type="number" class="form-control" id="medium" name="medium"
                                                        value="{{ $product->medium }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="large">Large</label>
                                                    <input type="number" class="form-control" id="large" name="large"
                                                        value="{{ $product->large }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="xlarge">Extra Large</label>
                                                    <input type="number" class="form-control" id="xlarge" name="xlarge"
                                                        value="{{ $product->xlarge }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Stock</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $products->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-5') }}

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="season">Season</label>
                                <select class="form-control" id="season" name="season" required>
                                    <option value="Summer">Summer</option>
                                    <option value="Winter">Winter</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="Formal">Formal</option>
                                    <option value="Casual">Casual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="small">Small</label>
                                <input type="number" class="form-control" id="small" name="small" required>
                            </div>
                            <div class="form-group">
                                <label for="medium">Medium</label>
                                <input type="number" class="form-control" id="medium" name="medium" required>
                            </div>
                            <div class="form-group">
                                <label for="large">Large</label>
                                <input type="number" class="form-control" id="large" name="large" required>
                            </div>
                            <div class="form-group">
                                <label for="xlarge">Extra Large</label>
                                <input type="number" class="form-control" id="xlarge" name="xlarge" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
