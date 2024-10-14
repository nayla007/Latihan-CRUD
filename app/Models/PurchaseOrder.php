<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    public function material()
    {
        return $this->belongsTo(Material::class); // Belongs to Material (relasi banyak ke satu)
    }

    // Relasi dengan Supplier (jika ada)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Menentukan kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_pembelian',
        'jumlah_pembelian',
        'tanggal',
        'material_id',
        'supplier_id',
        'deskripsi',
    ];
}
