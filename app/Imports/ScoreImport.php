<?php

namespace App\Imports;

use App\Models\Score;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScoreImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row);
        // exit;
        return new Score([
            'result_no'         => $row['result'],
            'name'              => $row['name'],
            'student_id'        => $row['id'],
            'score_l'           => $row['l'],
            'score_r'           => $row['r'],
            'score_total'       => $row['tot'],
            'group'             => $row['group'],
            'position'          => $row['position'],
            'category'          => $row['category'],
            'test_date'         => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['test_date']),
            'last_score_l'      => $row['l_2'],  // ganti kalau heading excel diedit
            'last_score_r'      => $row['r_2'],
            'last_score_total'  => $row['tot_2'],
        ]);
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }
}
