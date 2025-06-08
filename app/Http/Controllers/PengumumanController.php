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
        $pengumumans = Pengumuman::all();
        // dd($pengumumans); 
        // exit;

        return view('admin.create-pengumuman', [
            'pengumumans' => $pengumumans,
        ]);
    }

    public function storePengumuman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|min:10',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ], [
            'judul.required' => 'Judul pengumuman harus diisi.',
            'judul.max' => 'Judul pengumuman tidak boleh lebih dari 255 karakter.',
            'isi.required' => 'Deskripsi pengumuman harus diisi.',
            'isi.min' => 'Deskripsi pengumuman minimal 10 karakter.',
            'file.required' => 'File pengumuman harus diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, JPG, JPEG, atau PNG.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 5MB.',
        ]);

        try {
            // Jika checkbox is_active dicentang, set semua pengumuman lain menjadi non-aktif
            if ($request->has('is_active')) {
                Pengumuman::where('is_active', true)->update(['is_active' => false]);
            }
            
            // Upload file
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('pengumuman', $fileName, 'public');
            
            // Simpan pengumuman
            Pengumuman::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'file' => $filePath,
                'is_active' => $request->has('is_active') ? true : false,
            ]);
            
            $message = 'Pengumuman berhasil ditambahkan';
            if ($request->has('is_active')) {
                $message .= ' dan langsung ditampilkan di laman peserta';
            }
            
            return redirect()->back()->with('success', $message . '.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pengumuman: ' . $e->getMessage());
        }
    }

    public function showPengumuman()
    {
        //
        $pengumuman = Pengumuman::latest()->first();

        return view('peserta.dashboard', [
            "pengumuman" => $pengumuman
        ]);
    }

    
}
