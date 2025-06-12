<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    //
    public function createPengumuman()
    {
        $pengumumans = Pengumuman::all();

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
            if ($request->has('status')) {
                Pengumuman::where('status', 0)->update(['status' => 1]);
            }
            
            // Upload file
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('pengumuman', $fileName, 'public');
            
            // Simpan pengumuman
            Pengumuman::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'file' => $filePath,
                'status' => $request->has('status') ? 0 : 1,
            ]);
            
            $message = __('pengumuman.success');
            if ($request->has('status')) {
                $message .= ' dan langsung ditampilkan di laman peserta';
            }
            
            return redirect()->back()->with('success', $message . '.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('pengumuman.error') . $e->getMessage());
        }
    }

    public function showPengumuman()
    {

        $pengumuman = Pengumuman::where('status', 0 )->latest()->first();

        return view('peserta.dashboard', [
            "pengumuman" => $pengumuman
        ]);
    }

    public function toggleStatus($id)
    {
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return back()->with('error', __('pengumuman.stnf'));
        }

        $pengumuman->status = !$pengumuman->status;

        if ($pengumuman->save()) {
            return back()->with('success', __('pengumuman.stg'));
        } else {
            return back()->with('error', __('pengumuman.stng'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;

        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('pengumuman', $fileName, 'public');
            $pengumuman->file = $filePath;
        }

        $pengumuman->status = $request->has('status') ? 0 : 1;
        $pengumuman->save();

        return redirect()->back()->with('success',__('pengumuman.success'));
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->file && Storage::disk('public')->exists($pengumuman->file)) {
            Storage::disk('public')->delete($pengumuman->file);
        }

        $pengumuman->delete();

        return redirect()->back()->with('success', __('pengumuman.std'));
    }
    
}
