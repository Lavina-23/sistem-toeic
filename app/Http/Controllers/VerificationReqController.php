<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Models\VerificationReq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VerificationReqController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all');

        $query = VerificationReq::with('pengguna');
        // dd($query);
        // exit;

        if ($filter === 'with_bukti') {
            $query->whereNotNull('bukti_pendukung');
        } elseif ($filter === 'without_bukti') {
            $query->whereNull('bukti_pendukung');
        }

        $verificationReqs = $query->get()->map(function ($req) {
            return [
                'id' => $req->id ? $req->id : null,
                'pengguna_id' => $req->pengguna ? $req->pengguna->pengguna_id : null,
                'nama' => $req->pengguna ? $req->pengguna->nama : null,
                'keterangan' => $req->keterangan,
                'bukti_pendukung' => $req->bukti_pendukung,
                'status' => $req->status,
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
        $user = Auth::user();
        $peserta = Peserta::where('pengguna_id', $user->pengguna_id)->first();
        $score = Score::where('no_induk', $peserta->no_induk ?? '')->first();
        $requests = VerificationReq::where('pengguna_id', $user->pengguna_id)
            ->orderByDesc('created_at')
            ->get();
        $rejectionReason = VerificationReq::where('pengguna_id', $user->pengguna_id)
            ->where('status', 'rejected')
            ->latest()
            ->value('alasan');

        return view('peserta.requestDokumen', [
            'request' => $requests,
            'peserta' => $peserta,
            'score' => $score,
            'rejectionReason' => $rejectionReason,
            'userData' => $user,
        ]);
    }


    public function storeRequest(Request $request)
    {
        $verifData = $request->validate([
            'keterangan' => 'required|string|max:255',
            'bukti_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $verifData['pengguna_id'] = Auth::user()->pengguna_id;
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

    public function updateVerification(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $id = $request->input('id');
        $status = $request->input('status');
        $reason = $request->input('reason');

        VerificationReq::where('id', $id)->update([
            'status' => $status,
            'alasan' => $reason,
            'updated_at' => now(),
        ]);
        // dd($request->all());
        // exit;

        return redirect()->route('verificationReq')
            ->with('success', 'Status verifikasi diperbarui menjadi ' . $status);
    }
}
