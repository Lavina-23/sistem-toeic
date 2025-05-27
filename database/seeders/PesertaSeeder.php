<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Peserta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Peserta::insert([
            [
                'pengguna_id' => 1,
                'nama' => 'Ach Khoiron Athoillah',
                'no_induk' => '2131120059',
                'nik' => '1234567890123001',
                'no_telp' => '081234567001',
                'alamat_asal' => 'Jl. Mawar No. 15, Malang, Jawa Timur',
                'alamat_sekarang' => 'Jl. Mawar No. 15, Malang, Jawa Timur',
                'tgl_lahir' => '1995-03-12',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_1.jpg',
                'ktm' => 'ktm_1.jpg',
                'foto' => 'foto_1.jpg',
            ],
            [
                'pengguna_id' => 2,
                'nama' => 'Ahnaf Irsyad',
                'no_induk' => '2131120019',
                'nik' => '1234567890123002',
                'no_telp' => '081234567002',
                'alamat_asal' => 'Jl. Melati No. 22, Surabaya, Jawa Timur',
                'alamat_sekarang' => 'Jl. Melati No. 22, Surabaya, Jawa Timur',
                'tgl_lahir' => '1996-07-08',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_2.jpg',
                'ktm' => 'ktm_2.jpg',
                'foto' => 'foto_2.jpg',
            ],
            [
                'pengguna_id' => 3,
                'nama' => 'Andhika Putra Agung',
                'no_induk' => '2041160109',
                'nik' => '1234567890123003',
                'no_telp' => '081234567003',
                'alamat_asal' => 'Jl. Kenanga No. 7, Yogyakarta, DIY',
                'alamat_sekarang' => 'Jl. Kenanga No. 7, Yogyakarta, DIY',
                'tgl_lahir' => '1994-11-25',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_3.jpg',
                'ktm' => 'ktm_3.jpg',
                'foto' => 'foto_3.jpg',
            ],
            [
                'pengguna_id' => 4,
                'nama' => 'Annisa Zakiyah Najib',
                'no_induk' => '2041350020',
                'nik' => '1234567890123004',
                'no_telp' => '081234567004',
                'alamat_asal' => 'Jl. Flamboyan No. 33, Bandung, Jawa Barat',
                'alamat_sekarang' => 'Jl. Flamboyan No. 33, Bandung, Jawa Barat',
                'tgl_lahir' => '1997-02-14',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_4.jpg',
                'ktm' => 'ktm_4.jpg',
                'foto' => 'foto_4.jpg',
            ],
            [
                'pengguna_id' => 5,
                'nama' => 'Ayu Rosalinda',
                'no_induk' => '2042530018',
                'nik' => '1234567890123005',
                'no_telp' => '081234567005',
                'alamat_asal' => 'Jl. Anggrek No. 18, Jakarta Selatan, DKI Jakarta',
                'alamat_sekarang' => 'Jl. Anggrek No. 18, Jakarta Selatan, DKI Jakarta',
                'tgl_lahir' => '1998-05-20',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_5.jpg',
                'ktm' => 'ktm_5.jpg',
                'foto' => 'foto_5.jpg',
            ],
            [
                'pengguna_id' => 6,
                'nama' => 'Bagus Nur Huda',
                'no_induk' => '2041170040',
                'nik' => '1234567890123006',
                'no_telp' => '081234567006',
                'alamat_asal' => 'Jl. Cempaka No. 9, Semarang, Jawa Tengah',
                'alamat_sekarang' => 'Jl. Cempaka No. 9, Semarang, Jawa Tengah',
                'tgl_lahir' => '1995-09-03',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_6.jpg',
                'ktm' => 'ktm_6.jpg',
                'foto' => 'foto_6.jpg',
            ],
            [
                'pengguna_id' => 7,
                'nama' => 'Daffa Hafizhan Nugraha',
                'no_induk' => '2131210079',
                'nik' => '1234567890123007',
                'no_telp' => '081234567007',
                'alamat_asal' => 'Jl. Dahlia No. 28, Solo, Jawa Tengah',
                'alamat_sekarang' => 'Jl. Dahlia No. 28, Solo, Jawa Tengah',
                'tgl_lahir' => '1996-12-16',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_7.jpg',
                'ktm' => 'ktm_7.jpg',
                'foto' => 'foto_7.jpg',
            ],
        ]);
        
}
}
