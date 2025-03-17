<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            'nik' => '1234567890123456',
            'nama' => 'JOHN DOE',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Merdeka No. 1',
            'hobi' => json_encode(['Membaca', 'Olahraga']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
