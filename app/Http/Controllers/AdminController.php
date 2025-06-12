<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Twilio\Rest\Client;
use App\Models\Pengumuman;
use App\Imports\ScoreImport;
use App\Models\VerificationPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = Peserta::whereDoesntHave('score');

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
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $perPage = $request->input('perPage', 10);

    $peserta = $query->paginate($perPage);

    $peserta->appends($request->all());

    return view('admin.dashboard', [
        'peserta' => $peserta,
    ]);
}


    public function exportPDF()
    {
        $peserta = Peserta::all();

        $pdf = Pdf::loadView('admin.peserta-pdf', compact('peserta'));
        return $pdf->download('data_peserta.pdf');
    }

    public function exportPengguna()
    {
        $pengguna = Pengguna::all();

        $pdf = Pdf::loadView('admin.pengguna-pdf', compact('pengguna'));
        return $pdf->download('data_pengguna.pdf');
    }

    public function daftarPengguna(Request $request)
    {
        $query = Pengguna::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('level', 'like', "%{$search}%");
            });
        }

        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }

        $perPage = $request->input('perPage', 10);

        $pengguna = $query->paginate($perPage);

        return view('admin.daftarPengguna', [
            'pengguna' => $pengguna,
        ]);
    }

    public function storePengguna(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'level' => 'required|in:admin,peserta,ITC',
            'password' => 'required|string|min:6',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}
