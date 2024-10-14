<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CopyUsersToSuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua data dari tabel users
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('suppliers')->insert([
                'nama' => $user->nama,                  // Menyalin nama dari users
                'alamat' => $user->alamat,              // Menyalin alamat dari users
                'email' => $user->email,                // Menyalin email dari users
                'nomor_telepon' => $user->nomor_handphone, // Menyalin nomor handphone dari users
            ]);
        }

        echo "Data berhasil disalin dari users ke suppliers.\n";
    }
}
