<?php

namespace App\Imports;

use Illuminate\Support\Facades\Log;
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
        if (empty(array_filter($row))) {
            return null;
        }

        // return new Score([
        //     'result_no'         => $row[0] ?? null,      // First column
        //     'name'              => $row[1] ?? null,      // Second column
        //     'no_induk'          => $row[2] ?? null,      // Third column
        //     'score_l'           => $row[3] ?? 0,         // Fourth column
        //     'score_r'           => $row[4] ?? 0,         // Fifth column
        //     'score_total'       => $row[5] ?? 0,         // Sixth column
        //     'group'             => $row[6] ?? null,      // Seventh column
        //     'position'          => $row[7] ?? null,      // Eighth column
        //     'category'          => $row[8] ?? null,      // Ninth column
        //     'test_date'         => isset($row[9]) && $row[9]
        //         ? \Carbon\Carbon::parse($row[9])->format('Y-m-d H:i:s')
        //         : null,
        //     'last_score_l'      => $row[10] ?? 0,
        //     'last_score_r'      => $row[11] ?? 0,
        //     'last_score_total'  => $row[12] ?? 0,
        // ]);
        return new Score([
            'result_no'         => $row['result'],
            'name'              => $row['name'],
            'no_induk'          => $row['id'],
            'score_l'           => $row['l'],
            'score_r'           => $row['r'],
            'score_total'       => $row['tot'],
            'group'             => $row['group'],
            'position'          => $row['position'],
            'category'          => $row['category'],
            'test_date'         => \Carbon\Carbon::parse($row['test_date'])->format('Y-m-d H:i:s'),
            'last_score_l'      => $row['l_2'],
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
