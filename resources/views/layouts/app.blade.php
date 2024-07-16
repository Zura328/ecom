    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="icon" href="{{ asset('images/websiteLogo/4.png') }}" type="image/gif" sizes="16x16">
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="d-flex flex-column min-vh-100 ">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('fail'))
            <div class="alert alert-danger">
                {{ session()->get('fail') }}
            </div>
        @endif
        <div id="app" class="d-flex flex-column bg-white w-100 h-100" style="flex: 1">
            <div class="d-flex flex-column row w-100 h-100" style="flex: 1">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/websiteLogo/4.png') }}" alt="Logo"
                                style="height: 30px; margin-right: 10px;">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            @if (Auth::user() && Auth::user()->role != 'admin')
                                <ul class="navbar-nav me-auto">

                                    <li class="nav-item {{ Request::is('/') ? 'fw-bold' : '' }}">
                                        <a class="nav-link" href="/">Home</a>
                                    </li>
                                    @auth
                                        @if (Auth::user()->role == 'customer')
                                            <li class="nav-item {{ Request::is('products') ? 'fw-bold' : '' }}">
                                                <a class="nav-link" href="/products">Products</a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->role == 'delivery')
                                            <li class="nav-item {{ Request::is('delivery') ? 'fw-bold' : '' }}">
                                                <a class="nav-link" href="/delivery">Deliveries</a>
                                            </li>
                                        @endif
                                    @endauth
                                    <li class="nav-item {{ Request::is('contact') ? 'fw-bold' : '' }}">
                                        <a class="nav-link" href="/contact">Contact</a>
                                    </li>
                                </ul>
                            @endif
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name . ' ' . Auth::user()->role }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                                @auth
                                    @if (Auth::user()->role == 'customer')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('shipping.pending') }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                                </svg></a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="getcart()" class="nav-link" href="#" data-bs-toggle="modal"
                                                data-bs-target="#cartModal">
                                                <i class="fa fa-shopping-cart fs-2"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class=" row 100 h-100"
                    style="flex: 1;
                                        background-image: url('{{ asset('images/websiteLogo/bg.jpg') }}');
                                        background-color: #cccccc;
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;">
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar me-0">
                                <div class="position-sticky ps-3 pt-4">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('home') ? 'fw-bold' : '' }}"
                                                href="{{ route('home') }}">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="m-0">
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('products*') ? 'fw-bold' : '' }}"
                                                href="{{ route('products.index') }}">
                                                Products
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="m-0">
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('order*') ? 'fw-bold' : '' }}"
                                                href="{{ route('orders.index') }}">
                                                Orders
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="m-0">
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('shipping*') ? 'fw-bold' : '' }}"
                                                href="{{ route('shipping.index') }}">
                                                Shipping
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="m-0">
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        @endif
                    @endauth
                    <main class="py-4 col h-100">
                        @yield('content')
                    </main>

                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="bg-dark text-light text-center py-3 mt-auto">
            <div class="container">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved. (This is only
                    a
                    dummy website and not an actual store.)</p>
            </div>
        </footer>
        @yield('scripts')
        <!-- Cart Modal -->
        <form action="{{ url('/checkout') }}">
            <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul id="cart-items" class="list-group">
                                <!-- Pending orders will be loaded here -->
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz4fnFO9gybBogGz1mEXsuFb1p4VxNfA3pJoZ+xWI3p4x2QPY5PHV1wHvp" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuF4C3wuS5lTq9m9wSl0vZZeC7kPGlpMRTU29aDF+BhnDAJtf1gXtWAWx6DhFZ5M" crossorigin="anonymous">
        </script>
        <script>
            function getcart() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('orders.pending') }}',
                    method: 'GET',
                    success: function(data) {
                        $('#cart-items').empty();
                        if (data.length > 0) {
                            data.forEach(order => {
                                $('#cart-items').append(`
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/products/' . '${order.product.image}') }}" alt="${order.product.name}" class="img-fluid" style="max-width: 80px; max-height: 80px; margin-right: 15px;" onerror="this.onerror=null;this.src='{{ asset('images/websiteLogo/4.png') }}';">
                                            <div>
                                                <h5>${order.product.name}</h5>
                                                <p>Quantity: ${order.quantity}<br>
                                                Size: ${order.size}<br>
                                                Price: PHP${order.total_price}</p>
                                            </div>
                                        </div>
                                    </li>
                                `);
                            });
                        } else {
                            $('#cart-items').append('<li class="list-group-item">No pending orders</li>');
                        }
                    }
                });
            }
        </script>
    </body>

    </html>
