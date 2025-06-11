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
                'no_induk' => '1995031201',
                'nama' => 'Ach Khoiron Athoillah',
                'email' => 'ach.khoiron@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
                'alamat' => 'Jl. Mawar No. 15, Malang, Jawa Timur',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1995-03-12',
            ],
            [
                'no_induk' => '1996070802',
                'nama' => 'Ahnaf Irsyad',
                'email' => 'ahnaf.irsyad@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
                'alamat' => 'Jl. Melati No. 22, Surabaya, Jawa Timur',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1996-07-08',
            ],
            [
                'no_induk' => '1994112503',
                'nama' => 'Andhika Putra Agung',
                'email' => 'andhika.putra@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
                'alamat' => 'Jl. Kenanga No. 7, Yogyakarta, DIY',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1994-11-25',
            ],
            [
                'no_induk' => '1997021410',
                'nama' => 'Annisa Zakiyah Najib',
                'email' => 'annisa.zakiyah@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
                'alamat' => 'Jl. Flamboyan No. 33, Bandung, Jawa Barat',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1997-02-14',
            ],
            [
                'no_induk' => '1998052011',
                'nama' => 'Ayu Rosalinda',
                'email' => 'ayu.rosalinda@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
                'alamat' => 'Jl. Anggrek No. 18, Jakarta Selatan, DKI Jakarta',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1998-05-20',
            ],
            [
                'no_induk' => '1995090304',
                'nama' => 'Bagus Nur Huda',
                'email' => 'bagus.nur@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
                'alamat' => 'Jl. Cempaka No. 9, Semarang, Jawa Tengah',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1995-09-03',
            ],
            [
                'no_induk' => '1996121605',
                'nama' => 'Daffa Hafizhan Nugraha',
                'email' => 'daffa.hafizhan@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'peserta',
                'alamat' => 'Jl. Dahlia No. 28, Solo, Jawa Tengah',
                'tempat_lahir' => 'Solo',
                'tanggal_lahir' => '1996-12-16',
            ],
            [
                'no_induk' => '1990010106',
                'nama' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'admin',
                'alamat' => 'Jl. Sudirman No. 100, Jakarta Pusat, DKI Jakarta',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
            ],
            [
                'no_induk' => '2004040507',
                'nama' => 'Tokuno Yushi',
                'email' => 'tokuno.yushi@example.com',
                'password' => bcrypt('1234567890'),
                'level' => 'itc',
                'alamat' => 'Jl. Wish No. 1000, Jakarta Pusat, DKI Jakarta',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2004-04-05',
            ],
        ]);
    }
}
