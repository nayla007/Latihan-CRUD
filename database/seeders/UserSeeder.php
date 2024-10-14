<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data di tabel users
        DB::table('users')->truncate(); // Ini akan mengosongkan tabel users

        // Tambahkan data baru
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'nomor_handphone' => $faker->unique()->phoneNumber,
            ]);
        }
        User::create([
            'nama' => 'Nama Pengguna',  // Menambahkan nilai untuk kolom nama
            'email' => 'uyucat@gmail.com',
            'alamat' => 'Jl. Contoh Alamat, No. 123', // Menambahkan alamat
            'nomor_handphone' => '081234567890', // Menambahkan nomor handphone
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        User::factory()->count(10)->create();
    }
}
