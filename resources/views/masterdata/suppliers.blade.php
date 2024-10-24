@extends('adminlte::page')

@section('title', 'Supplier List')

@section('content_header')
    <h1>Supplier List</h1>
@stop
@section('css')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <!-- Tombol Create Supplier -->
    <a href="{{ route('master-data.create_supplier') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Supplier</a>

    <!-- Tabel Data Supplier -->
    <div class="col-md-12">
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Suppliers</h3>
    </div>
    <div class="card-body">
    <table id="supplierTable" class="table DataTable table-hovered table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th> <!-- Kolom Aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $index => $supplier)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $supplier->nama }}</td>
                    <td>{{ $supplier->alamat }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->nomor_handphone }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="{{ route('master-data.edit_supplier', $supplier->id) }}" class="btn btn-warning btn-sm fas fa-edit">Edit</a>

                        
                        <!-- Tombol Delete -->
                        <form action="{{ route('master-data.destroy_supplier', $supplier->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">
                                <i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
            </div>
</div>
@stop

@section('js')
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    let table = new DataTable('#supplierTable')
</script>
@stop