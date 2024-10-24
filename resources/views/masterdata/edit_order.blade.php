@extends('adminlte::page')

@section('title', 'Edit Purchase Order')

@section('content_header')
    <h1>Edit Purchase Order</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Purchase Order Form</h3>
        </div>
        <div class="card-body">
            <!-- Form untuk mengedit purchase order -->
            <form action="{{ route('master-data.update_purchase_order', $purchaseOrder->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Untuk method PUT karena ini adalah update -->

                <!-- Nama Pembelian -->
                <div class="form-group">
                    <label for="nama_pembelian">Nama Pembeli</label>
                    <input type="text" name="nama_pembelian" class="form-control" id="nama_pembelian" value="{{ old('nama_pembelian', $purchaseOrder->nama_pembelian) }}" required>
                </div>

                <!-- Jumlah Pembelian -->
                <div class="form-group">
                    <label for="jumlah_pembelian">Jumlah Pembelian</label>
                    <input type="number" name="jumlah_pembelian" class="form-control" id="jumlah_pembelian" value="{{ old('jumlah_pembelian', $purchaseOrder->jumlah_pembelian) }}" required>
                </div>

                <!-- Tanggal Pembelian -->
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ old('tanggal', $purchaseOrder->tanggal) }}" required>
                </div>

                <!-- Material -->
                <div class="form-group">
                    <label for="material_id">Material</label>
                    <select name="material_id" class="form-control" required>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" {{ $material->id == old('material_id', $purchaseOrder->material_id) ? 'selected' : '' }}>
                                {{ $material->nama_material }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div class="form-group">
                    <label for="supplier_id">Supplier</label>
                    <select name="supplier_id" class="form-control" required>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == old('supplier_id', $purchaseOrder->supplier_id) ? 'selected' : '' }}>
                                {{ $supplier->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi">{{ old('deskripsi', $purchaseOrder->deskripsi) }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> Update</button>
                <a href="{{ route('master-data.purchase_order') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Cancel</a>
            </form>
        </div>
    </div>
@stop
