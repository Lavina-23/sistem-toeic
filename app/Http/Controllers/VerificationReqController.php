<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Models\VerificationReq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VerificationReqController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all');

        $query = VerificationReq::with('peserta');

        if ($filter === 'with_bukti') {
            $query->whereNotNull('bukti_pendukung');
        } elseif ($filter === 'without_bukti') {
            $query->whereNull('bukti_pendukung');
        }

        $verificationReqs = $query->get()->map(function ($req) {
            return [
                'id' => $req->id,
                'peserta_id' => $req->peserta_id,
                'nama' => $req->peserta ? $req->peserta->nama : null,
                'keterangan' => $req->keterangan,
                'bukti_pendukung' => $req->bukti_pendukung,
                'created_at' => $req->created_at->format('Y-m-d H:i'),
            ];
        });

        return view('admin.verificationRequest', [
            'verificationReqs' => $verificationReqs,
            'filter' => $filter,
        ]);
    }

    public function requestDocument()
    {
        // $user = Auth::user();
        $hasRequested = VerificationReq::where('peserta_id', Auth::user()->peserta->peserta_id)->exists();

        return view('peserta.requestDokumen', [
            'hasRequested' => $hasRequested,
        ]);
    }

    public function storeRequest(Request $request)
    {
        $verifData = $request->validate([
            'keterangan' => 'required|string|max:255',
            'bukti_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $verifData['peserta_id'] = Auth::user()->peserta->peserta_id;
            $verifData['keterangan'] = $request->keterangan;
            if ($request->hasFile('bukti_pendukung')) {
                $verifData['bukti_pendukung'] = $request->file('bukti_pendukung')->store('bukti_pendukung', 'public');
            }

            VerificationReq::create($verifData);

            return redirect()->back()->with('success', 'Permintaan verifikasi berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim permintaan verifikasi: ' . $e->getMessage());
        }
    }
}
