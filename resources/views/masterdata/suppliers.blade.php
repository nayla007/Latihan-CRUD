@extends('adminlte::page')

@section('title', 'Supplier List')

@section('content_header')
    <h1>Supplier List</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Create Supplier -->
    <a href="{{ route('master-data.create_supplier') }}" class="btn btn-primary mb-3">Tambah Supplier</a>

    <!-- Form untuk Reset ID dan Hapus data dari 10 sampai 19 -->
    <form action="{{ route('suppliers.reset') }}" method="POST" class="mb-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus dari 10 sampai 19 dan Reset ID</button>
    </form>

    <!-- Tabel Data Supplier -->
    <table class="table table-bordered">
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
                        <a href="{{ route('master-data.edit_supplier', $supplier->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        
                        <!-- Tombol Delete -->
                        <form action="{{ route('master-data.destroy_supplier', $supplier->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
