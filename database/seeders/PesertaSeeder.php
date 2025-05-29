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
                'tgl_lahir' => '2001-01-01',
                'alamat_asal' => 'Alamat Asal 1',
                'alamat_sekarang' => 'Alamat Sekarang 1',
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
                'tgl_lahir' => '2002-02-02',
                'alamat_asal' => 'Alamat Asal 2',
                'alamat_sekarang' => 'Alamat Sekarang 2',
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
                'tgl_lahir' => '2003-03-03',
                'alamat_asal' => 'Alamat Asal 3',
                'alamat_sekarang' => 'Alamat Sekarang 3',
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
                'tgl_lahir' => '2004-04-04',
                'alamat_asal' => 'Alamat Asal 4',
                'alamat_sekarang' => 'Alamat Sekarang 4',
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
                'no_telp' => '087765776316',
                'tgl_lahir' => '2005-05-05',
                'alamat_asal' => 'Alamat Asal 5',
                'alamat_sekarang' => 'Alamat Sekarang 5',
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
                'tgl_lahir' => '2006-06-06',
                'alamat_asal' => 'Alamat Asal 6',
                'alamat_sekarang' => 'Alamat Sekarang 6',
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
                'tgl_lahir' => '2007-07-07',
                'alamat_asal' => 'Alamat Asal 7',
                'alamat_sekarang' => 'Alamat Sekarang 7',
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
