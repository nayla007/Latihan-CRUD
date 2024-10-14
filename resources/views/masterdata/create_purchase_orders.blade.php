@extends('adminlte::page')

@section('title', 'Create Purchase Order')

@section('content_header')
    <h1>Create Purchase Order</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Enter Purchase Order Details</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('purchase_orders.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_pembelian">Nama Pembelian</label>
                    <input type="text" name="nama_pembelian" class="form-control" id="nama_pembelian" value="{{ old('nama_pembelian') }}" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_pembelian">Jumlah Pembelian</label>
                    <input type="number" name="jumlah_pembelian" class="form-control" id="jumlah_pembelian" value="{{ old('jumlah_pembelian') }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ old('tanggal') }}" required>
                </div>
                <div class="form-group">
                    <label for="material_id">Material</label>
                    <select name="material_id" class="form-control" id="material_id" required>
                        <option value="">Select Material</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                {{ $material->nama_material }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_id">Supplier</label>
                    <select name="supplier_id" class="form-control" id="supplier_id" required>
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deksripsi</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('master-data.purchase_order') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@stop
