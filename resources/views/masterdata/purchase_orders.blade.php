@extends('adminlte::page')

@section('title', 'Purchase Orders')

@section('content_header')
    <h1>Purchase Orders</h1>
@stop

@section('content')
    <!-- Tampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk Tambah Purchase Order Baru -->
    <a href="{{ route('master-data.create_purchase_order') }}" class="btn btn-primary mb-3">Create New Purchase Order</a>

    <!-- Tabel Daftar Purchase Orders -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Purchase Orders</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pembelian</th>
                        <th>Jumlah Pembelian</th>
                        <th>Tanggal</th>
                        <th>Material</th>
                        <th>Supplier</th>
                        <th>Deskripsi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->nama_pembelian }}</td>
                            <td>{{ $order->jumlah_pembelian }}</td>
                            <td>{{ $order->tanggal }}</td>
                            <td>{{ optional($order->material)->nama_material ?? 'Material not found'}}</td>
                            <td>{{ optional($order->supplier)->nama ?? 'Supplier not found' }}</td>
                            <td>{{ $order->deskripsi }}</td>
                            <td>
                                <a href="{{ route('master-data.edit_purchase_order', $order->id) }}" class="btn btn-warning">Edit</a>
                                
                                <form action="{{ route('master-data.delete_purchase_order', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
