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
        // dd($row['test_date']);
        // exit;
        if (empty(array_filter($row))) {
            return null;
        }

        return Score::updateOrCreate(
            ['result_no'         => $row['result']],
            [
                'name'              => $row['name'],
                'no_induk'          => $row['id'],
                'score_l'           => $row['l'],
                'score_r'           => $row['r'],
                'score_total'       => $row['tot'],
                'group'             => $row['group'],
                'position'          => $row['position'],
                'category'          => $row['category'],
                'test_date' => $row['test_date'] ? (function () use ($row) {
                    try {
                        $excelEpoch = new \DateTime('1899-12-30');
                        $days = intval($row['test_date']);

                        if ($days > 0) {
                            $date = clone $excelEpoch;
                            $date->add(new \DateInterval('P' . $days . 'D'));
                            return $date->format('Y-m-d H:i:s');
                        }

                        return null;
                    } catch (\Exception $e) {
                        return null;
                    }
                })() : null,
                'last_score_l'      => $row['l_2'],
                'last_score_r'      => $row['r_2'],
                'last_score_total'  => $row['tot_2'],
            ]
        );
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }
}
