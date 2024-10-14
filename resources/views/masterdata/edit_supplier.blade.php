@extends('adminlte::page')

@section('title', 'Edit Supplier')

@section('content_header')
    <h1>Edit Supplier</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Supplier Form</h3>
        </div>
        <div class="card-body">
            <!-- Form untuk mengedit supplier -->
            <form action="{{ route('master-data.update_supplier', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Untuk method PUT karena ini adalah update -->

                <div class="form-group">
                    <label for="nama">Nama Supplier</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $supplier->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Address</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat', $supplier->alamat) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $supplier->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="nomor_telepon">Phone Number</label>
                    <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" value="{{ old('nomor_telepon', $supplier->nomor_telepon) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('master-data.supplier') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@stop
