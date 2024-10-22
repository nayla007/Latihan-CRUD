@extends('adminlte::page')

@section('title', 'Dashboard')

<!-- Custom Styles -->
<link rel="stylesheet" href="{{ asset('resources/css/custom.css') }}">

@section('content_header')
    <h1 class="text-center font-weight-bold text-dark">Welcome to Your Dashboard</h1>
@stop

@section('content')
<div class="row">
    <!-- Total Users Card -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box bg-gradient-primary shadow-lg rounded-3">
            <div class="inner p-4">
                <h3 class="font-weight-bold text-white">{{ $userCount }}</h3>
                <p class="text-uppercase font-weight-bold text-white">Total Users</p>
            </div>
            <div class="icon top-50 start-50 translate-middle">
                <i class="fas fa-users fa-3x text-white"></i>
            </div>
            <a href="{{ route('master-data.user') }}" class="btn btn-light w-100 mt-3 py-2 text-uppercase">Go to Users</a>
        </div>
    </div>

    <!-- Total Suppliers Card -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box bg-gradient-success shadow-lg rounded-3">
            <div class="inner p-4">
                <h3 class="font-weight-bold text-white">{{ $supplierCount }}</h3>
                <p class="text-uppercase font-weight-bold text-white">Total Suppliers</p>
            </div>
            <div class="icon top-50 start-50 translate-middle">
                <i class="fas fa-truck fa-3x text-white"></i>
            </div>
            <a href="{{ route('master-data.supplier') }}" class="btn btn-light w-100 mt-3 py-2 text-uppercase">Go to Suppliers</a>
        </div>
    </div>

    <!-- Total Materials Card -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box bg-gradient-warning shadow-lg rounded-3">
            <div class="inner p-4">
                <h3 class="font-weight-bold text-white">{{ $materialCount }}</h3>
                <p class="text-uppercase font-weight-bold text-white">Total Materials</p>
            </div>
            <div class="icon top-50 start-50 translate-middle">
                <i class="fas fa-cogs fa-3x text-white"></i>
            </div>
            <a href="{{ route('master-data.material') }}" class="btn btn-light w-100 mt-3 py-2 text-uppercase">Go to Materials</a>
        </div>
    </div>

    <!-- Total Purchase Orders Card -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box bg-gradient-danger shadow-lg rounded-3">
            <div class="inner p-4">
                <h3 class="font-weight-bold text-white">{{ $purchaseOrderCount }}</h3>
                <p class="text-uppercase font-weight-bold text-white">Total Purchase Orders
                    
                </p>
            </div>
            <div class="icon top-50 start-50 translate-middle">
                <i class="fas fa-box fa-3x text-white"></i>
            </div>
            <a href="{{ route('master-data.purchase_order') }}" class="btn btn-light w-100 mt-3 py-2 text-uppercase">
                Go to Purchase Orders</a>
        </div>
    </div>
</div>

<!-- Total Products Card -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box bg-gradient-info shadow-lg rounded-3">
            <div class="inner p-4 text-white">
                <h3 class="font-weight-bold">{{ $productsCount }}</h3>
                <p class="text-uppercase font-weight-bold">Total Products</p>
            </div>
            <div class="icon top-50 start-50 translate-middle">
                <i class="fas fa-tags fa-3x text-white"></i>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-light w-100 mt-3 py-2 text-uppercase">Go to Products</a>
        </div>
    </div>
</div>

<!-- Chart for Summary Data -->
<div class="row mb-5">
    <div class="col-md-12">
        <canvas id="myChart" style="height: 400px;"></canvas>
    </div>
</div>

<!-- Pie Chart for Category Distribution -->
<div class="row mb-4">
    <div class="col-md-6 mb-4">
        <canvas id="pieChart" style="height: 30px; width: 30px;"></canvas>
    </div>

    <!-- Line Chart for Users Trend -->
    <div class="col-md-6 mb-4">
        <canvas id="lineChart" style="height: 350px;"></canvas>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        .small-box {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            justify-content: space-between;
        }

        .small-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            background-color: rgba(0, 0, 0, 0.1);
        }

        .bg-gradient-primary {
            background: linear-gradient(to right, 
            #2980b9, 
            #2c3e50) !important;
        }

        .bg-gradient-success {
            background: linear-gradient(to right, #00b09b, #96c93d) !important;
        }

        .bg-gradient-warning {
            background: linear-gradient(to right, #ff7e5f, #feb47b) !important;
        }

        .bg-gradient-danger {
            background: linear-gradient(to right, #ff4b1f, #ff9068) !important;
        }

        .bg-gradient-info {
            background: linear-gradient(to right,
            #8e0e00, 
            #1f1c18) !important;
        }

        .icon i {
            opacity: 0.5; /* Ikon akan menjadi 80% transparan */
            color: rgba(255, 255, 255, 0.5);
            position: absolute;
            z-index: 10;
            
        }

        .small-box .inner {
            position: relative;
            z-index: 1; /* Memberikan prioritas pada teks agar tidak tertutup ikon */
            
        }



    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar Chart for Summary Data
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Suppliers', 'Materials', 'Purchase Orders', 'Products'],
                datasets: [{
                    label: 'Total',
                    data: [{{ $userCount }}, {{ $supplierCount }}, {{ $materialCount }}, {{ $purchaseOrderCount }},{{ $productsCount }}],
                    backgroundColor: [
                        '#4facfe',  // Blue for Users
                        '#00b09b',  // Green for Suppliers
                        '#ff7e5f',  // Orange for Materials
                        '#ff4b1f',  // Red for Purchase Orders
                        '#3ec1c0'   // Teal for Products
                    ],
                    borderColor: [
                        '#4facfe',
                        '#00b09b',
                        '#ff7e5f',
                        '#ff4b1f',
                        '#3ec1c0'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Pie Chart for Distribution
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Users', 'Suppliers', 'Materials', 'Orders', 'Products'],
                datasets: [{
                    data: [{{ $userCount }}, {{ $supplierCount }}, {{ $materialCount }}, {{ $purchaseOrderCount }}, {{ $productsCount }}],
                    backgroundColor: ['#4facfe', '#ff7e5f', '#ff9068', '#00b09b', '#3ec1c0'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
                
            }
        });

        // Line Chart for Users Trend
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Users Trend',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#00b09b',
                    backgroundColor: 'rgba(0, 176, 155, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@stop
