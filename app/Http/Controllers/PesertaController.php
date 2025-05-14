<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('peserta.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPeserta()
    {
        //
        return view('peserta.daftar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePeserta(Request $request)
    {
        $user = Auth::user();
        $registered = Peserta::where('pengguna_id', $user->pengguna_id)->first();

        if (!$registered) {
            $validatedData = $request->validate([
                // 'nama' => 'required|string|max:255',
                'no_induk' => 'required|string|max:255',
                'nik' => 'required|string|max:255',
                'no_telp' => 'required|string|max:255',
                'alamat_asal' => 'required|string|max:255',
                'alamat_sekarang' => 'required|string|max:255',
                'jurusan' => 'string|max:255',
                'program_studi' => 'string|max:255',
                'kampus' => 'required|string|max:255',
                'ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'ktm' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            try {
                $validatedData['pengguna_id'] = $user->pengguna_id;
                $validatedData['nama'] = $user->nama;
                $validatedData['ktp'] = $request->file('ktp')->store('ktp', 'public');
                $validatedData['ktm'] = $request->file('ktm')->store('ktm', 'public');
                $validatedData['foto'] = $request->file('foto')->store('foto', 'public');

                Peserta::create($validatedData);

                return redirect()->route('peserta.dashboard')->with('success', 'Pendaftaran berhasil!');
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi error saat menyimpan: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('peserta.dashboard')->with('error', 'Anda sudah terdaftar!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $user = Auth::user();
        $peserta = Peserta::where('pengguna_id', $user->pengguna_id)->first();

        return view('peserta.dashboard', ['peserta' => $peserta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
        //
    }
}
