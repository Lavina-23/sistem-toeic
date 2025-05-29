<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    //
    public function createPengumuman()
    {
        return view('admin.create-pengumuman');
    }

    public function storePengumuman(Request $request)
    {

        $user = Auth::user();
        $registered = Peserta::where('pengguna_id', $user->pengguna_id)->first();

        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        try {

            // Jika file diunggah, simpan ke storage
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Buat nama file baru berdasarkan judul, contoh: JADWAL TOEIC → JADWAL_TOEIC.pdf
                $namaFile = str_replace(' ', '_', strtoupper($request->judul)) . '.' . $file->getClientOriginalExtension();

                // Simpan file ke folder 'pengumuman' di disk 'public' dengan nama tersebut
                $path = $file->storeAs('pengumuman', $namaFile, 'public');

                $validatedData['file'] = $path;
            }

            // Simpan pengumuman ke database
            Pengumuman::create($validatedData);

            return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showPengumuman()
    {
        //
        $pengumuman = pengumuman::latest()->first();

        return view('peserta.dashboard', [
            "pengumuman" => $pengumuman
        ]);
    }
}
