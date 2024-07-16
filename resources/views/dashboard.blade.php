@extends('layouts.app')

@section('content')
    <div class="container">

        <head>
            <!-- Other meta tags and styles -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        </head>
        <h1 class="text-white">Dashboard</h1>
        <!-- Cards for metrics -->
        <div class="row">
            <!-- Total Products Card -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text">{{ $totalProducts }}</p>
                        <a href="{{ route('products.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <!-- Total Orders Card -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">{{ $totalOrders }}</p>
                        <a href="{{ route('orders.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <!-- Pending Orders Card -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Orders</h5>
                        <p class="card-text">{{ $pendingOrders }}</p>
                        <!-- Replace with the correct route for pending orders if needed -->
                        <a href="{{ route('orders.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <!-- Total Revenue Card -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <p class="card-text">PHP {{ number_format($totalRevenue, 2) }}</p>
                        <a href="{{ route('shipping.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mt-5">
            <!-- Orders by Status Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Orders by Status</h5>
                        <canvas id="ordersByStatusChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Shipping Status Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Shipping Status</h5>
                        <div style="" class="w-100 text-center">
                            <canvas id="shippingStatusChart" style=" " class="mx-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Script Section for Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Orders by Status Chart
            var ctxOrders = document.getElementById('ordersByStatusChart').getContext('2d');
            var myChartOrders = new Chart(ctxOrders, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($orderStatusLabels) !!},
                    datasets: [{
                        label: 'Number of Orders',
                        data: {!! json_encode($orderStatusData) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Shipping Status Chart
            var ctxShipping = document.getElementById('shippingStatusChart').getContext('2d');
            var myChartShipping = new Chart(ctxShipping, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($shippingStatusLabels) !!},
                    datasets: [{
                        label: 'Shipping Status',
                        data: {!! json_encode($shippingStatusData) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
