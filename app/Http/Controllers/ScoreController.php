<?php

namespace App\Http\Controllers;

use App\Imports\ScoreImport;
use App\Models\Peserta;
use App\Models\Score;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ScoreController extends Controller
{
    //
    public function createScores()
    {
        //
        return view('admin.create-scores');
    }

    public function importScores(Request $request)
    {
        //
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ScoreImport, $request->file('file'));
        return back()->with('success', 'Data berhasil diimpor!');
    }

    public function getScoreData()
    {
        //
        $user = auth()->user();
        $no_induk = Peserta::where('pengguna_id', $user->pengguna_id)->first()->no_induk;
        $scores = Score::where('no_induk', $no_induk)->get(['score_total', 'last_score_total', 'score_l', 'last_score_l', 'score_r', 'last_score_r']);

        return response()->json($scores);
    }
}
