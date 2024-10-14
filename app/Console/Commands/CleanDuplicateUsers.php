<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CleanDuplicateUsers extends Command
{
    protected $signature = 'users:clean-duplicates';
    protected $description = 'Clean duplicate users from the database';

    public function handle()
    {
        // Mencari data yang duplikat berdasarkan email dan nomor_handphone
        $duplicates = User::select('email', 'nomor_handphone', DB::raw('count(*) as total'))
        ->groupBy('email', 'nomor_handphone')
        ->havingRaw('count(*) > 1')
        ->get();

        // Menghapus semua duplikat
        foreach ($duplicates as $duplicate) {
            // Ambil semua user dengan kombinasi email dan nomor_handphone yang sama
            $users = User::where('email', $duplicate->email)
                ->where('nomor_handphone', $duplicate->nomor_handphone)
                ->get();

            // Hapus semua kecuali satu record
            $users->shift(); // Menghapus satu record dari koleksi
            $users->each->delete(); // Hapus sisanya
        }

        $this->info('Duplikat berhasil dihapus!');
    }

    
}
