<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan data ke tabel user
        User::insert([
            
                'nama' => 'John Doe',
                'alamat' => 'Jl. Merdeka No. 10',
                'email' => 'johndoe@example.com',
                'nomor_handphone' => '08123456789',
        ]);

    // Tambahkan data ke tabel supplier
    Supplier::create([
        'nama' => 'Supplier A',
        'alamat' => 'Jl. Raya No. 20',
        'email' => 'suppliera@example.com',
        'nomor_handphone' => '08123456789',
    ]);

    // Tambahkan data ke tabel material
    Material::create([
        'nama_material' => 'Material 1',
        'unit' => 'kg',
        'harga' => 100000,
        'brand' => 'Brand A',
        'part_number' => 'MTR001',
        'deskripsi' => 'Deskripsi Material 1',
    ]);

    // Tambahkan data ke tabel purchase_order
    PurchaseOrder::create([
        'nama_pembelian' => 'Pembelian 1',
        'jumlah_pembelian' => 10,
        'tanggal' => '2024-10-03',
        'material_id' => 1,
        'supplier_id' => 1,
        'deskripsi' => 'Deskripsi PO 1',
    ]);

    $this->call([
        UserSeeder::class,
    ]);
    
    }
}
