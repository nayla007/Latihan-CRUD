<?php

namespace App\Console\Commands;

use App\Models\Supplier;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanDuplicateSuppliers extends Command
{
    protected $signature = 'suppliers:clean-duplicates';
    protected $description = 'Clean duplicate suppliers from the database';

    public function handle()
    {
        // Mencari data yang duplikat berdasarkan email dan nomor_handphone
        $duplicates = Supplier::select('email', 'nomor_handphone', DB::raw('count(*) as total'))
        ->groupBy('email', 'nomor_handphone')
        ->havingRaw('count(*) > 1')
        ->get();

        // Menghapus semua duplikat
        foreach ($duplicates as $duplicate) {
            // Ambil semua user dengan kombinasi email dan nomor_handphone yang sama
            $suppliers = Supplier::where('email', $duplicate->email)
                ->where('nomor_handphone', $duplicate->nomor_handphone)
                ->get();

            // Hapus semua kecuali satu record
            $suppliers->shift(); // Menghapus satu record dari koleksi
            $suppliers->each->delete(); // Hapus sisanya
        }

        $this->info('Duplikat berhasil dihapus!');
    }

    
}
