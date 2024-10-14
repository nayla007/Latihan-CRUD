<?php

namespace Database\Seeders;

use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materials')->insert([
            [
                'brand' => 'iPhone 13 Pro Max',
                'nama_material' => 'Handphone',
                'part_number' => '5',
                'unit' => 'pcs',
                'harga' => 100000,
                'deskripsi' => 'Smartphone flagship dengan layar OLED dan kamera canggih.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand' => 'Lenovo',
                'nama_material' => 'Laptop',
                'part_number' => '3',
                'unit' => 'unit',
                'harga' => 7000000,
                'deskripsi' => 'Laptop dengan performa tinggi dan layar 15 inci.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand' => 'Logitech',
                'nama_material' => 'Keyboard',
                'part_number' => '2',
                'unit' => 'pcs',
                'harga' => 500000,
                'deskripsi' => 'Keyboard mekanik dengan switch yang responsif.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        Material::create([
            'nama_material' => 'Handphone',
            'brand' => 'Samsung',  // Menambahkan nilai untuk kolom 'brand'
            'harga' => 5000000,  // Pastikan kolom harga diisi
            'unit' => 'pcs',
            'part_number' => 'HP-12345',
            'deskripsi' => 'ini adalah handphone yang sangat-sangat luar biasa(saya BA nya)',
            'updated_at' => now(),
            'created_at' => now(),
        ]);
    }
}
