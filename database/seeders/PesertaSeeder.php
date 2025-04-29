<?php

namespace Database\Seeders;

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
                'pengguna_id' => 3,
                'nama' => 'John Doe',
                'no_induk' => '12345678',
                'nik' => '9876543210123456',
                'no_telp' => '081234567890',
                'alamat_asal' => 'Jl. Mawar No. 1, Jakarta',
                'alamat_sekarang' => 'Jl. Melati No. 2, Bandung',
                'jurusan' => 'Teknik Informatika',
                'program_studi' => 'Sistem Informasi',
                'kampus' => 'Utama',
                'ktp' => 'ktp_john_doe.jpg',
                'ktm' => 'ktm_john_doe.jpg',
                'foto' => 'foto_john_doe.jpg',
                'attempt_status' => 1,
            ],
            [
                'pengguna_id' => 2,
                'nama' => 'Jane Smith',
                'no_induk' => '87654321',
                'nik' => '1234567890123456',
                'no_telp' => '082345678901',
                'alamat_asal' => 'Jl. Kenanga No. 3, Surabaya',
                'alamat_sekarang' => 'Jl. Cempaka No. 4, Malang',
                'jurusan' => 'Sistem Informasi',
                'program_studi' => 'Teknik Komputer',
                'kampus' => 'PSDKU Kediri',
                'ktp' => 'ktp_jane_smith.jpg',
                'ktm' => 'ktm_jane_smith.jpg',
                'foto' => 'foto_jane_smith.jpg',
                'attempt_status' => 0,
            ],
        ]);
    }
}
