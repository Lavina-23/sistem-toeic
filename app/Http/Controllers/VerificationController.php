<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Models\VerificationPhotos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{
    //
    public function index(Request $request)
    {
        $sortir = $request->input('sortir', 'semua');
        $pesertas = Peserta::with('verificationPhotos')->whereDoesntHave('score')->get(['peserta_id', 'nama', 'no_telp']);
        // dd($pesertas);
        // exit;

        if ($sortir === 'belum_lengkap') {
            $peserta = $this->getPesertaBelumLengkap();
        } elseif ($sortir === 'belum_kirim') {
            $peserta = $this->getPesertaBelumKirim();
        } else {
            $peserta = $pesertas->map(function ($p) {
                $photos = collect($p->verificationPhotos)->keyBy('photo_type');

                return [
                    'peserta_id' => $p->peserta_id,
                    'nama'       => $p->nama,
                    'no_telp'    => $p->no_telp,
                    'front' => $photos->has('front') ? $photos['front']->photo_path : null,
                    'back'  => $photos->has('back') ? $photos['back']->photo_path : null,
                    'left'  => $photos->has('left') ? $photos['left']->photo_path : null,
                    'right' => $photos->has('right') ? $photos['right']->photo_path : null,
                ];
            });
        }

        return view('itc.verification-photos', [
            'peserta' => $peserta,
            'sortir' => $sortir,
        ]);
    }

    public function getPesertaBelumLengkap()
    {
        $pesertaBelumLengkap = Peserta::with(['verificationPhotos'])
            ->withCount([
                'verificationPhotos as jumlah_foto' => function ($query) {
                    $query->select(DB::raw('COUNT(DISTINCT photo_type)'));
                }
            ])
            ->having('jumlah_foto', '>', 0)
            ->having('jumlah_foto', '<', 4)
            ->get(['peserta_id', 'nama', 'no_telp']);

        $pesertaBelumLengkap = $pesertaBelumLengkap->map(
            function ($peserta) {
                $photos = $peserta->verificationPhotos->keyBy('photo_type');

                return [
                    'peserta_id' => $peserta->peserta_id,
                    'nama'       => $peserta->nama,
                    'no_telp'    => $peserta->no_telp,
                    'front'      => $photos['front']->photo_path ?? null,
                    'back'       => $photos['back']->photo_path ?? null,
                    'left'       => $photos['left']->photo_path ?? null,
                    'right'      => $photos['right']->photo_path ?? null,
                ];
            }
        );

        return $pesertaBelumLengkap;
    }

    public function getPesertaBelumKirim()
    {
        $pesertaBelumKirim = Peserta::withCount([
            'verificationPhotos as jumlah_foto' => function ($query) {
                $query->select(DB::raw('COUNT(DISTINCT photo_type)'));
            }
        ])->having('jumlah_foto', '=', 0)->get(['peserta_id', 'nama', 'no_telp']);

        return $pesertaBelumKirim;
    }
}
