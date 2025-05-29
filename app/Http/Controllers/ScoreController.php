<?php

namespace App\Http\Controllers;

use App\Imports\ScoreImport;
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
}
