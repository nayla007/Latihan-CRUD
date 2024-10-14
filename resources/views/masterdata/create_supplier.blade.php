@extends('adminlte::page')

@section('title', 'Create Supplier')

@section('content_header')
    <h1>Create Supplier</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Address</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">Phone Number</label>
                    <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" value="{{ old('nomor_telepon') }}" required>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('master-data.supplier') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@stop
