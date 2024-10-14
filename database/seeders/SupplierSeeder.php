<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;  // Import DB Facade
class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('suppliers')->truncate(); 
        
        for ($i = 1; $i <= 10; $i++) {
        DB::table('suppliers')->insert([
            'nama' => $faker->name,  // Supplier A, Supplier B, etc.
            'alamat' => $faker->address,
            'email' => $faker->email,
            'nomor_telepon' => $faker->phoneNumber,
        ]);
    }
    // Reset sequence auto-increment untuk memulai ID dari 1
    DB::statement('ALTER SEQUENCE suppliers_id_seq RESTART WITH 1');

    DB::table('suppliers')->truncate();
    DB::table('suppliers')->insert([
        'nama' => 'kia',
        'alamat' => 'jalan nanas',
        'email' => 'sayafo3101@horsgit.com',
        'nomor_telepon' => '+62 890-5560-390',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}   
}
