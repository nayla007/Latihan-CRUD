@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
    <h1>Create User</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="nomor_handphone">Nomor handphone</label>
                    <input type="text" name="nomor_handphone" class="form-control" id="nomor_handphone" value="{{ old('nomor_handphone') }}" required>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('master-data.user') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@stop
