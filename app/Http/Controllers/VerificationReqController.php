<?php

namespace App\Http\Controllers;

use App\Models\VerificationReq;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
