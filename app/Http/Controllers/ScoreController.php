<?php

namespace App\Http\Controllers;

use App\Imports\ScoreImport;
use App\Models\Peserta;
use App\Models\Score;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ScoreController extends Controller
{
    public function createScores()
    {
        // Get all scores with pagination
        $scores = Score::orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.create-scores', compact('scores'));
    }

    public function importScores(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ScoreImport, $request->file('file'));
        return back()->with('success', 'Data berhasil diimpor!');
    }

    public function getScoreData()
    {
        $user = auth()->user();
        $no_induk = Peserta::where('pengguna_id', $user->pengguna_id)->first()->no_induk;
        $scores = Score::where('no_induk', $no_induk)->get(['score_total', 'last_score_total', 'score_l', 'last_score_l', 'score_r', 'last_score_r']);

        return response()->json($scores);
    }

    public function show($id)
    {
        $score = Score::findOrFail($id);
        return response()->json($score);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_induk' => 'required|string|max:255',
            'score_l' => 'required|numeric',
            'score_r' => 'required|numeric',
            'score_total' => 'required|numeric',
            'group' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'test_date' => 'nullable|date',
        ]);

        $score = Score::findOrFail($id);
        $score->update($request->all());

        return redirect()->route('admin.scores')->with('success', 'Data score berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $score = Score::findOrFail($id);
            $score->delete();

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data!'], 500);
        }
    }

    public function search(Request $request)
    {
        $query = Score::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('no_induk', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        if ($request->has('group') && !empty($request->group)) {
            $query->where('group', $request->group);
        }

        $scores = $query->orderBy('created_at', 'desc')->paginate(20);

        return response()->json([
            'html' => view('admin.partials.score-table-rows', compact('scores'))->render(),
            'pagination' => $scores->links()->render()
        ]);
    }
}