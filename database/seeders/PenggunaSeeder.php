<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pengguna::insert([
            [
                'email' => 'admin@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'admin',
            ],
            [
                'email' => 'peserta@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'email' => 'peserta2@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
        ]);
    }
}
