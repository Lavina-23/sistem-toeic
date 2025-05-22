<?php

namespace App\Http\Controllers;

use App\Imports\ScoreImport;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = Peserta::query();

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('no_induk', 'like', "%{$search}%")
              ->orWhere('program_studi', 'like', "%{$search}%");
        });
    }

    if ($request->has('sort') && $request->has('direction')) {
        $query->orderBy($request->sort, $request->direction);
    }

    $perPage = $request->input('perPage', 10);

    $peserta = $query->paginate($perPage);

    return view('admin.dashboard', compact('peserta'));
}


    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}