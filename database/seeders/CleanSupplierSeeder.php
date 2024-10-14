<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CleanSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus duplikat berdasarkan kombinasi kolom
        DB::table('suppliers')
            ->select('nama', 'alamat', 'email', 'nomor_telepon', DB::raw('MIN(id) as id'))
            ->groupBy('nama', 'alamat', 'email', 'nomor_telepon')
            ->havingRaw('COUNT(*) > 1')
            ->delete();
    }
}
