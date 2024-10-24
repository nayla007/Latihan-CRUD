@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit User Form</h3>
        </div>
        <div class="card-body">
            <!-- Form untuk mengedit user -->
            <form action="{{ route('master-data.update_user', $user->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Untuk method PUT karena ini adalah update -->

                <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $user->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Address</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat', $user->alamat) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="nomor_handphone">Phone Number</label>
                    <input type="text" name="nomor_handphone" class="form-control" id="nomor_handphone" value="{{ old('nomor_handphone', $user->nomor_handphone) }}" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> Update</button>
                <a href="{{ route('master-data.user') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Cancel</a>
            </form>
        </div>
    </div>
@stop

