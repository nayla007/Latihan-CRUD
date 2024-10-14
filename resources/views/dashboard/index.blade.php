@extends('adminlte::page')

@section('title', 'Dashboard')
<link rel="stylesheet" href="{{ asset('resources/css/custom.css') }}">

@section('content_header')
    <h1>Welcome To My Dashboard</h1>
@stop

@section('content')
<div class="row">
    <!-- Total Users Card -->
    <div class="col-lg-3 col-md-4 col-sm-6">  <!-- Menyesuaikan ukuran kolom -->
        <div class="small-box bg-info" style="height: 150px;">
            <div class="inner">
                <h3>{{ $userCount }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('master-data.user') }}" class="btn btn-secondary">Go to Users</a>

        </div>
    </div>

        <!-- Total Suppliers Card -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success" style="height: 150px;">
                <div class="inner">
                    <h3>{{ $supplierCount }}</h3>
                    <p>Total Suppliers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-truck"></i>
                </div>
                <a href="{{ route('master-data.supplier') }}" class="btn btn-secondary">Go to Users</a>

            </div>
        </div>

        <!-- Total Materials Card -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning" style="height: 150px;">
                <div class="inner">
                    <h3>{{ $materialCount }}</h3>
                    <p>Total Materials</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <a href="{{ route('master-data.material') }}" class="btn btn-secondary">Go to Users</a>
            </div>
        </div>

        <!-- Total Purchase Orders Card -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger" style="height: 150px;">
                <div class="inner">
                    <h3>{{ $purchaseOrderCount }}</h3>
                    <p>Total Purchase Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <a href="{{ route('master-data.purchase_order') }}" class="btn btn-secondary">Go to Users</a>

            </div>
        </div>
    </div>

    <!-- Chart for Summary Data -->
    <div class="row">
        <div class="col-md-12">
            <canvas id="myChart" style="width: 100%; height: 250px; max-height: 500px;"></canvas>
        </div>
    </div>

    <!-- Pie Chart for Category Distribution -->
    <div class="row">
        <div class="col-md-6">
            <canvas id="pieChart" style="width: 25px; height: 20px;"></canvas>
        </div>

        <!-- Line Chart for Users Trend -->
        <div class="col-md-6">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // Tipe chart adalah bar
    data: {
        labels: ['Users', 'Suppliers', 'Materials', 'Purchase Orders'], // Label data
        datasets: [{
            label: 'Total',
            data: [{{ $userCount }}, {{ $supplierCount }}, {{ $materialCount }}, {{ $purchaseOrderCount }}], // Data yang ditampilkan
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',  // Blue for Users
                'rgba(75, 192, 192, 0.2)',  // Green for Suppliers
                'rgba(255, 159, 64, 0.2)',  // Orange for Materials
                'rgba(255, 99, 132, 0.2)'   // Red for Purchase Orders
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',  // Blue for Users
                'rgba(75, 192, 192, 1)',  // Green for Suppliers
                'rgba(255, 159, 64, 1)',  // Orange for Materials
                'rgba(255, 99, 132, 1)'   // Red for Purchase Orders
            ],
            borderWidth: 1 // Lebar border pada batang
        }]
    },
    options: {
        responsive: true, // Menyusun chart responsif
        maintainAspectRatio: false, // Agar chart mengatur ukurannya berdasarkan lebar dan tinggi
        scales: {
            x: {
                beginAtZero: true,
                grid: {
                    display: false // Menghilangkan grid pada sumbu x
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    display: true, // Menampilkan grid pada sumbu y
                    color: 'rgba(0, 0, 0, 0.1)' // Memberikan warna grid yang lebih soft
                }
            }
        },
        plugins: {
            legend: {
                position: 'top', // Menempatkan legend di atas chart
                labels: {
                    boxWidth: 15, // Ukuran kotak di legend
                    font: {
                        size: 14, // Ukuran font pada label legend
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw; // Menampilkan label dengan nilai
                    }
                }
            }
        },
        barPercentage: 0.5, // Mengatur lebar batang agar tidak terlalu lebar
        categoryPercentage: 0.8 // Mengatur jarak antar kategori
    }
});


        // Pie Chart for Distribution
        var ctx = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(ctx, {
    type: 'pie', // Tipe chart adalah 'pie'
    data: {
        labels: ['Users', 'Suppliers', 'Materials', 'Orders'],
        datasets: [{
            data: [{{ $userCount }}, {{ $supplierCount }}, {{ $materialCount }}, {{ $purchaseOrderCount }}],
            backgroundColor: ['#36A2EB', '#FF9F40', '#FFCD56', '#4BC0C0'],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 50, // Mengubah ukuran lingkaran (default: 50%)
        radius: '100%', // Mengatur ukuran lingkaran secara keseluruhan
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});
        // Line Chart for Users Trend (Example, you could replace this with actual time series data)
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Users Trend',
                    data: [12, 19, 3, 5, 2, 3], // This is sample data; replace with actual trend data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
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
