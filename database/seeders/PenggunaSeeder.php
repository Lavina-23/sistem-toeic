<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{

    public function run(): void
    {
        //
        Pengguna::insert([
            [
                'nama' => 'Ach Khoiron Athoillah',
                'email' => 'ach.khoiron@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'nama' => 'Ahnaf Irsyad',
                'email' => 'ahnaf.irsyad@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'nama' => 'Andhika Putra Agung',
                'email' => 'andhika.putra@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'nama' => 'Annisa Zakiyah Najib',
                'email' => 'annisa.zakiyah@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'nama' => 'Ayu Rosalinda',
                'email' => 'ayu.rosalinda@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'nama' => 'Bagus Nur Huda',
                'email' => 'bagus.nur@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'nama' => 'Daffa Hafizhan Nugraha',
                'email' => 'daffa.hafizhan@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
            ],
            [
                'nama' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'admin',
            ],
        ]);
    }
}
