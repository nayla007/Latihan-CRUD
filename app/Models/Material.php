<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    protected $table = 'materials';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_material',
        'brand',
        'harga',  // Pastikan 'harga' ada dalam fillable
        'unit',
        'part_number',
        'deskripsi',
        'created_at',
        'updated_at',
    ];
}
