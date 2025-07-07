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
        $search = $request->input('search'); // Ambil input search

        $query = VerificationReq::with('pengguna');

        if ($filter === 'with_bukti') {
            $query->whereNotNull('bukti_pendukung');
        } elseif ($filter === 'without_bukti') {
            $query->whereNull('bukti_pendukung');
        }

        // ✅ Tambahkan filter pencarian nama pengguna
        if ($search) {
            $query->whereHas('pengguna', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        $verificationReqs = $query->get()->map(function ($req) {
            return [
                'id' => $req->id,
                'pengguna_id' => optional($req->pengguna)->pengguna_id,
                'nama' => optional($req->pengguna)->nama,
                'keterangan' => $req->keterangan,
                'bukti_pendukung' => $req->bukti_pendukung,
                'status' => $req->status,
                'score_total' => $req->score_total,
                'last_score_total' => $req->last_score_total,
                'created_at' => $req->created_at->format('Y-m-d H:i'),
            ];
        });

        return view('admin.verificationRequest', [
            'verificationReqs' => $verificationReqs,
            'filter' => $filter,
            'search' => $search,
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

        $latestRejected = VerificationReq::where('pengguna_id', $user->pengguna_id)
            ->where('status', 'rejected')
            ->orderByDesc('created_at')
            ->first();

        $rejectionReason = $latestRejected ? $latestRejected->alasan : null;

        $latestStatus = $requests->first() ? $requests->first()->status : null;

        return view('peserta.requestDokumen', [
            'request' => $requests,
            'peserta' => $peserta,
            'score' => $score,
            'rejectionReason' => $rejectionReason,
            'latestStatus' => $latestStatus,
            'userData' => $user,
        ]);
    }


    public function storeRequest(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'keterangan_khusus' => 'nullable|string|max:255',
            'bukti_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $finalKeterangan = $validated['keterangan'] === 'Khusus'
            ? $request->input('keterangan_khusus')
            : 'Nilai';

        $verifData = [
            'pengguna_id' => $user->pengguna_id,
            'keterangan' => $finalKeterangan,
        ];

        try {
            if ($request->hasFile('bukti_pendukung')) {
                $verifData['bukti_pendukung'] = $request->file('bukti_pendukung')->store('bukti_pendukung', 'public');
            } elseif ($finalKeterangan === 'Nilai') {
                $verifData['score_total'] = $user->peserta->score->score_total ?? 0;
                $verifData['last_score_total'] = $user->peserta->score->last_score_total ?? 0;
            } else {
                return redirect()->back()->with('error', 'Bukti pendukung harus diunggah untuk keterangan selain Nilai.');
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

        $status = $request->input('status');
        $reason = $request->input('reason');

        VerificationReq::where('id', $id)->update([
            'status' => $status,
            'alasan' => $reason,
            'updated_at' => now(),
        ]);

        return redirect()->route('verificationReq')
            ->with('success', 'Status verifikasi diperbarui menjadi ' . $status);
    }
}
