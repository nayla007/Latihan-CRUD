@extends('adminlte::page')

@section('title', 'Create Material')

@section('content_header')
    <h1>Create Material</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <form action="{{ route('master-data.store_material') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_material">Name</label>
                    <input type="text" name="nama_material" class="form-control" id="nama_material" value="{{ old('nama_material') }}" required>
                </div>
                <div class="form-group">
                    <label for="unit">Unit</label>
                    <input type="text" name="unit" class="form-control" id="unit" value="{{ old('unit') }}" required>
                </div>
                <div class="form-group">
                    <label for="harga">Price</label>
                    <input type="number" name="harga" class="form-control" id="harga" value="{{ old('harga') }}" required>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" class="form-control" id="brand" value="{{ old('brand') }}">
                </div>
                <div class="form-group">
                    <label for="part_number">Part Number</label>
                    <input type="text" name="part_number" class="form-control" id="part_number" value="{{ old('part_number') }}">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Description</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi">{{ old('deskripsi') }}</textarea>
                </div>
                <button type="submit" class="btn btn-success fas fa-save"> Save</button>
                <a href="{{ route('master-data.material') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Cancel</a>
            </form>
        </div>
    </div>
@stop
