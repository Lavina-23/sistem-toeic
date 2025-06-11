<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PesertaExport extends TextValueBinder implements FromArray, WithMapping, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function map($row): array
    {
        return [
            (string) $row['nama'],
            (string) $row['no_induk'],
            (string) $row['nik'],
            (string) $row['no_telp'],
            (string) $row['tgl_lahir'],
            (string) $row['alamat_asal'],
            (string) $row['alamat_sekarang'],
            (string) $row['jurusan'],
            (string) $row['program_studi'],
            (string) $row['kampus']
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'No Induk',
            'NIK',
            'No Telepon',
            'Tanggal Lahir',
            'Alamat Asal',
            'Alamat Sekarang',
            'Jurusan',
            'Program Studi',
            'Kampus'
        ];
    }
}
