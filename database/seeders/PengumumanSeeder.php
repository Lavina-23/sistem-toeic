<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pengumuman::insert([
            [
                'judul' => 'Pengumuman 1',
                'isi' => 'Isi pengumuman pertama.',
                'file' => 'file1.pdf',
            ],
            [
                'judul' => 'Pengumuman 2',
                'isi' => 'Isi pengumuman kedua.',
                'file' => 'file2.pdf',
            ],
            [
                'judul' => 'Pengumuman 3',
                'isi' => 'Isi pengumuman ketiga.',
                'file' => 'file3.pdf',
            ],
        ]);
    }
}
