@extends('adminlte::page')

@section('title', 'Purchase Orders')

@section('content_header')
    <h1>Purchase Orders</h1>
@stop

@section('css')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
@stop

@section('content')
    <!-- Tampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk Tambah Purchase Order Baru -->
    <a href="{{ route('master-data.create_purchase_order') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Create New Order</a>

    <!-- Tabel Daftar Purchase Orders -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Purchase Orders</h3>
        </div>
        <div class="card-body">
            <table id="orderTable" class="table table-bordered table-striped">
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
                    @foreach($purchaseOrders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->nama_pembelian }}</td>
                            <td>{{ $order->jumlah_pembelian }}</td>
                            <td>{{ $order->tanggal }}</td>
                            <td>{{ optional($order->material)->nama_material ?? 'Material not found'}}</td>
                            <td>{{ optional($order->supplier)->nama ?? 'Supplier not found' }}</td>
                            <td>{{ $order->deskripsi }}</td>
                            <td>
                                <a href="{{ route('master-data.edit_purchase_order', $order->id) }}" class="btn btn-warning btn-sm fas fa-edit">Edit</a>
                                
                                <form action="{{ route('master-data.delete_purchase_order', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        <i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    let table = new DataTable('#orderTable')
</script>
@stop
